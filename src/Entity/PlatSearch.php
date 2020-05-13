<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class PlatSearch {
    /**
     * @var float|null
     */
    private $maxPrice ;

    /**
     * @var ArrayCollection|null
     */
    private $ingrediants;

    public function __construct(){
        $this->ingrediants = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getMaxPrice(): ?float
    {
        return $this->maxPrice;
    }

    public function setMaxPrice(float $maxPrice)
    {
        $this->maxPrice = $maxPrice;
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