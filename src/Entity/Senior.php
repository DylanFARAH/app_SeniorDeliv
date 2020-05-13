<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SeniorRepository")
 */
class Senior
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mail;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $n_tel;

    /**
     * @ORM\Column(type="boolean",options={"default":true})
     */
    private $actif;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Ingrediant", inversedBy="alerg")
     */
    private $allergies;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Commande", inversedBy="seniors")
     */
    private $orders;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="senior", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $compte;

    public function __construct()
    {
        $this->allergies = new ArrayCollection();
        $this->orders = new ArrayCollection();
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }
    
    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getNTel(): ?string
    {
        return $this->n_tel;
    }

    public function setNTel(string $n_tel): self
    {
        $this->n_tel = $n_tel;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->nom.".".$this->prenom;
    }

    public function setUsername(): self
    {
        //$this->username = $this->nom.".".$this->prenom;
        return $this;
    }

    /*public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(): self
    {
        $this->code = $this->genererMdp(8);

        return $this;
    }*/

    public function isActif(): ?bool
    {
        return $this->actif;
    }

    public function setActif(bool $actif): self
    {
        $this->actif = $actif;

        return $this;
    }

    public function genererMdp($nbChar)
    {
        return substr(str_shuffle('mnoTUzS5678kVvwxy9WXYZRNCDEFrslq41GtuaHIJKpOPQA23LcdefghiBMbj0'),1, $nbChar); 
    }


    /**
     * @return Collection|Ingrediant[]
     */
    public function getAllergies(): Collection
    {
        return $this->allergies;
    }

    public function addAllergies(Ingrediant $ingrediant): self
    {
        if (!$this->allergies->contains($ingrediant)) {
            $this->allergies[] = $ingrediant;
        }

        return $this;
    }

    public function removeAllergies(Ingrediant $ingrediant): self
    {
        if ($this->allergies->contains($ingrediant)) {
            $this->allergies->removeElement($ingrediant);
        }

        return $this;
    }

    /**
     * @return Collection|Commande[]
     */
    public function getCommandes(): Collection
    {
        return $this->orders;
    }

    public function addCommande(Commande $commande): self
    {
        if (!$this->orders->contains($commande)) {
            $this->orders[] = $commande;
            $commande->addSenior($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->orders->contains($commande)) {
            $this->orders->removeElement($commande);
            $commande->removeSenior($this);
        }

        return $this;
    }
    public function getCompte(): ?User
    {
        return $this->compte;
    }

    public function setCompte(User $compte): self
    {
        $this->compte = $compte;
        return $this;
    }

    public function isAllergie(Plat $plat)
    {
        foreach($this->allergies as $i)
        {
            foreach($plat->getIngrediants() as $ingrediant){
                if($i == $ingrediant){
                    return true ;
                }
            }
        }
        return false;
    }
}
