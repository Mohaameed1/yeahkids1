<?php

namespace App\Entity;

use App\Repository\TemperatureRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TemperatureRepository::class)
 */
class Temperature
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $firstpoint;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $secondpoint;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstpoint(): ?float
    {
        return $this->firstpoint;
    }

    public function setFirstpoint(?float $firstpoint): self
    {
        $this->firstpoint = $firstpoint;

        return $this;
    }

    public function getSecondpoint(): ?float
    {
        return $this->secondpoint;
    }

    public function setSecondpoint(?float $secondpoint): self
    {
        $this->secondpoint = $secondpoint;

        return $this;
    }



}
