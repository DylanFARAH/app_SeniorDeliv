<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Cocur\Slugify\Slugify;
use Symfony\Component\HttpFoundation\File\File;;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\PlatRepository")
 * @Vich\Uploadable
 */
class Plat
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=255)
     */
    private $filename;

    /**
     * @var File|null
     * @Assert\Image(mimeTypes="image/jpeg")
     * @Vich\UploadableField(mapping="property_image", fileNameProperty="filename")
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;

    /**
     * @ORM\Column(type="date")
     */
    private $date_debut;

    /**
     * @ORM\Column(type="date")
     */
    private $date_fin;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Ingrediant", inversedBy="properties")
     */
    private $ingrediants;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Commande", mappedBy="plats")
     */
    private $commandes;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Avis", inversedBy="prop")
     */
    private $avis;

    public function __construct()
    {
        $this->ingrediants = new ArrayCollection();
        $this->commandes = new ArrayCollection();
        $this->avis = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getSlug(): string
    {
        return (new Slugify())->slugify($this->nom);
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }
    public function getFormattedPrix(): string 
    {
        return number_format($this->prix,2,"."," ");
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->date_debut;
    }

    public function setDateDebut(\DateTimeInterface $date): self
    {
        $this->date_debut = $date;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->date_fin;
    }

    public function setDateFin(\DateTimeInterface $date): self
    {
        $this->date_fin = $date;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }


    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getFilename(): ?string
    {
        return $this->filename;
    }
    
    /**
     * 
     * @return Plat
     */
    public function setFilename(string $filename): self
    {
        $this->filename = $filename;

        return $this;
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageFile(?File $imageFile = null): self
    {
        /*$this->imageFile = $imageFile;
        $this->updated_at = new \DateTime('now');
        if ($this->imageFile instanceof UploadedFile) {
            $this->updated_at = new \DateTime('now');
        }*/
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updated_at = new \DateTime('now');
        }

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * @return Collection|Ingrediant[]
     */
    public function getIngrediants(): Collection
    {
        return $this->ingrediants;
    }

    public function addIngrediant(Ingrediant $ingrediant): self
    {
        if (!$this->ingrediants->contains($ingrediant)) {
            $this->ingrediants[] = $ingrediant;
            $ingrediant->addProperty($this);
        }

        return $this;
    }

    public function removeIngrediant(Ingrediant $ingrediant): self
    {
        if ($this->ingrediants->contains($ingrediant)) {
            $this->ingrediants->removeElement($ingrediant);
            $ingrediant->removeProperty($this);
        }

        return $this;
    }

    /**
     * @return Collection|Commande[]
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commande $commande): self
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes[] = $commande;
            $commande->addPlat($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->contains($commande)) {
            $this->commandes->removeElement($commande);
            $commande->removePlat($this);
        }

        return $this;
    }

    /**
     * @return Collection|Avis[]
     */
    public function getAvis(): Collection
    {
        return $this->avis;
    }

    public function addAvis(Avis $avis): self
    {
        if (!$this->avis->contains($avis)) {
            $this->avis[] = $avis;
            $avis->addProp($this);
        }

        return $this;
    }

    public function removeAvis(Avis $avis): self
    {
        if ($this->avis->contains($avis)) {
            $this->avis->removeElement($avis);
            $avis->removeProp($this);
        }

        return $this;
    }

    public function listIngrediant()
    {
        $list="";
        foreach($this->ingrediants as $ingrediant){
            $list= $list.",  ".$ingrediant->getNom() ;
        }
        return $list;
    }
}
