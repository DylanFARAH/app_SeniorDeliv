<?php
namespace App\Entity;

use Symfony\Component\Validator\Contrains as Assert;
use Doctrine\Common\Collections\ArrayCollection;

class Contact {
    /**
     * @var string|null
     */
    private $nom ;

    /**
     * @var string|null
     */
    private $prenom ;

        /**
     * @var string|null
     */
    private $phone ;

    /**
     * @var string|null
     */
    private $email ;
    
    /**
     * @var string|null
     */
    private $message ;


    public function getNom()
    {
        return $this->nom;
    }

    public function setNom(string $nom)
    {
        $this->nom = $nom;
        return $this;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom)
    {
        $this->prenom = $prenom;
        return $this;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone(string $phone)
    {
        $this->phone = $phone;
        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
        return $this;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage(string $message)
    {
        $this->message = $message;
        return $this;
    }

    

    

    /**
     * @return ArrayCollection|null
     */
    public function getIngrediants(): ?ArrayCollection
    {
        return $this->ingrediants;
    }

    public function setIngrediants(ArrayCollection $ingrediants)
    {
        $this->ingrediants = $ingrediants;
        return $this;
    }
}