<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommandeRepository")
 */
class Commande
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $creneaux;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Plat", inversedBy="commandes")
     */
    private $plats;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Senior", mappedBy="orders")
     */
    private $seniors;

    /**
     * @ORM\Column(type="boolean",options={"default":false})
     */
    private $payed;

    public function __construct()
    {
        $this->plats = new ArrayCollection();
        $this->seniors = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getCreneaux(): ?string
    {
        return $this->creneaux;
    }

    public function setCreneaux(string $creneaux): self
    {
        $this->creneaux = $creneaux;

        return $this;
    }

    /**
     * @return Collection|Plat[]
     */
    public function getPlats(): Collection
    {
        return $this->plats;
    }

    public function addPlat(Plat $plat): self
    {
        if (!$this->plats->contains($plat)) {
            $this->plats[] = $plat;
            $plat->addCommande($this);
        }

        return $this;
    }

    public function removePlat(Plat $plat): self
    {
        if ($this->plats->contains($plat)) {
            $this->plats->removeElement($plat);
            $plat->removeCommande($this);
        }

        return $this;
    }

    /**
     * @return Collection|Senior[]
     */
    public function getSenior(): Collection
    {
        return $this->seniors;
    }

    public function addSenior(Senior $senior): self
    {
        if (!$this->seniors->contains($senior)) {
            $this->seniors[] = $senior;
            $senior->addCommande($this);
        }

        return $this;
    }

    public function removeSenior(Senior $senior): self
    {
        if ($this->seniors->contains($senior)) {
            $this->seniors->removeElement($senior);
            $senior->removeCommande($this);
        }

        return $this;
    }

    public function CalculDate(int $i){
        $datejour = new \DateTime('now');
        $jour = $datejour->format('l');

        if($jour=="Monday" && $i==3){ return date('Y-m-d',strtotime('+3 day'));}
        if($jour=="Monday" && $i==4){ return date('Y-m-d',strtotime('+4 day'));}
        if($jour=="Monday" && $i==5){ return date('Y-m-d',strtotime('+5 day'));}

        if($jour=="Tuesday" && $i==4){ return date('Y-m-d',strtotime('+3 day'));}
        if($jour=="Tuesday" && $i==5){ return date('Y-m-d',strtotime('+4 day'));}

        if($jour=="Wednesday" && $i==5){ return date('Y-m-d',strtotime('+3 day'));}
    }

    public function isPayed(): ?bool
    {
        return $this->payed;
    }

    public function setPayed(bool $payed): self
    {
        $this->payed = $payed;
        return $this;
    }

    public function DatetoString(){
        return date_format($this->date, 'Y-m-d');
    }

    public function StringtoDate($date){
        $date = new \DateTime($date);
        return $date ;
        //return DateTime::createFromFormat('Y-m-d',$date);
    }
    

    public function Price(){
        $p=$this->getPlats();
        $prix=0;
        foreach ($p as $plat) {
                $prix=$prix + $plat->getPrix();   
        }
        return $prix;
    }

    public function Avis(){
        $date=new \DateTime('now');
        if($date > $this->date){
            return true;
        }
        return false;
    }

    public function Annuler(){
        
        if($this->StringtoDate(date('Y-m-d',strtotime('+2 day'))) <= $this->date){
            return true;
        }
        return false;
    }
}
