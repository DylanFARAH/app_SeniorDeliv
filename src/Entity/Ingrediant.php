<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IngrediantRepository")
 */
class Ingrediant
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
    private $categorie;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $substance;

    /**
     * @ORM\Column(type="integer")
     */
    private $Kcal;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Plat", mappedBy="ingrediants")
     */
    private $properties;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Senior", mappedBy="allergies")
     */
    private $alerg;

    public function __construct()
    {
        $this->alerg = new ArrayCollection();
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

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(string $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getSubstance(): ?string
    {
        return $this->substance;
    }

    public function setSubstance(string $substance): self
    {
        $this->substance = $substance;

        return $this;
    }

    public function getKcal(): ?int
    {
        return $this->Kcal;
    }

    public function setKcal(int $Kcal): self
    {
        $this->Kcal = $Kcal;

        return $this;
    }

    /**
     * @return Collection|Plat[]
     */
    public function getProperties(): Collection
    {
        return $this->properties;
    }

    public function addProperty(Plat $property): self
    {
        if (!$this->properties->contains($property)) {
            $this->properties[] = $property;
        }

        return $this;
    }

    public function removeProperty(Plat $property): self
    {
        if ($this->properties->contains($property)) {
            $this->properties->removeElement($property);
        }

        return $this;
    }

        /**
     * @return Collection|Senior[]
     */
    public function getSenior(): Collection
    {
        return $this->alerg;
    }

    public function addSenior(Senior $senior): self
    {
        if (!$this->alerg->contains($senior)) {
            $this->alerg[] = $senior;
            $senior->addAllergies($this);
        }

        return $this;
    }

    public function removeSenior(Senior $senior): self
    {
        if ($this->alerg->contains($senior)) {
            $this->alerg->removeElement($senior);
            $senior->removeAllergies($this);
        }

        return $this;
    }
}
