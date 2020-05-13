<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AvisRepository")
 */
class Avis
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $star;

    /**
     * @ORM\Column(type="string", length=1000, nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Plat", mappedBy="avis")
     */
    private $prop;

    public function __construct($star,$description)
    {
        $this->star=$star;
        $this->decription=$description;
        $this->prop = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStar(): ?int
    {
        return $this->star;
    }

    public function setStar(int $star): self
    {
        $this->star = $star;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Plat[]
     */
    public function getProp(): Collection
    {
        return $this->prop;
    }

    public function addProp(Plat $plat): self
    {
        if (!$this->prop->contains($plat)) {
            $this->prop[] = $plat;
            $plat->addAvis($this);
        }

        return $this;
    }

    public function removeProp(Plat $plat): self
    {
        if ($this->prop->contains($plat)) {
            $this->prop->removeElement($plat);
            $plat->removeAvis($this);
        }

        return $this;
    }
}
