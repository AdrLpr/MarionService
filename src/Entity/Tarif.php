<?php

namespace App\Entity;

use App\Repository\TarifRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TarifRepository::class)]
class Tarif
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $duree;

    #[ORM\Column(type: 'float')]
    private $prix;

    #[ORM\Column(type: 'string', length: 255)]
    private $tarifTemps;

    #[ORM\Column(type: 'boolean')]
    private $choix;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDuree(): ?string
    {
        return $this->duree;
    }

    public function setDuree(string $duree): self
    {
        $this->duree = $duree;

        return $this;
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

    public function getTarifTemps(): ?string
    {
        return $this->tarifTemps;
    }

    public function setTarifTemps(string $tarifTemps): self
    {
        $this->tarifTemps = $tarifTemps;

        return $this;
    }

    public function getChoix(): ?bool
    {
        return $this->choix;
    }

    public function setChoix(bool $choix): self
    {
        $this->choix = $choix;

        return $this;
    }
}
