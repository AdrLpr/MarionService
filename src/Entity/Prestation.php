<?php

namespace App\Entity;

use App\Repository\PrestationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PrestationRepository::class)]
class Prestation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $titre;

    #[ORM\Column(type: 'boolean')]
    private $choix;

    #[ORM\Column(type: 'array')]
    private $texte = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

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

    public function getTexte(): ?array
    {
        return $this->texte;
    }

    public function setTexte(array $texte): self
    {
        $this->texte = $texte;

        return $this;
    }
}
