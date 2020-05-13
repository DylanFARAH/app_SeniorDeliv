<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommandeRepository")
 */
class Planning
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="array")
     */
    private $current_week=["Monday" => ["Dejeuner"=>null,"deux"=>null],
    "Tuesday" => ["Dejeuner"=>null,"deux"=>null],
    "Wednesday" => ["Dejeuner"=>null,"deux"=>null],
    "Tursday" => ["Dejeuner"=>null,"deux"=>null],
    "Friday" => ["Dejeuner"=>null,"deux"=>null],
    "Saturday" => ["Dejeuner"=>null,"deux"=>null],
    ];
    /*["Monday" => ["Dejeuner"=>$commande1,"deux"=>$commande2],
                "Tuesday" => ["Dejeuner"=>$commande1,"deux"=>$commande2],
                "Wednesday" => ["Dejeuner"=>$commande1,"deux"=>$commande2],
                "Tursday" => ["Dejeuner"=>$commande1,"deux"=>$commande2],
                "Friday" => ["Dejeuner"=>$commande1,"deux"=>$commande2],
                "Saturday" => ["Dejeuner"=>$commande1,"deux"=>$commande2],
        ];*/

    /**
     * @ORM\Column(type="array")
     */
    private $coming_week=["Monday" => ["Dejeuner"=>null,"deux"=>null],
    "Tuesday" => ["Dejeuner"=>null,"deux"=>null],
    "Wednesday" => ["Dejeuner"=>null,"deux"=>null],
    "Tursday" => ["Dejeuner"=>null,"deux"=>null],
    "Friday" => ["Dejeuner"=>null,"deux"=>null],
    "Saturday" => ["Dejeuner"=>null,"deux"=>null],
    ];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCurrentWeek(): ?array
    {
        return $this->current_week;
    }

    public function setCurrentWeek(array $current_week): self
    {
        $this->current_week = $current_week;

        return $this;
    }

    public function getComingWeek(): ?array
    {
        return $this->coming_week;
    }

    public function setComingWeek(array $coming_week): self
    {
        $this->coming_week = $coming_week;

        return $this;
    }

    public function CalculDate(int $i){


    }
}
