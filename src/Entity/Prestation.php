<?php

namespace App\Entity;

use App\Repository\PrestationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PrestationRepository::class)]
class Prestation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'boolean')]
    private $choix;

    #[ORM\Column(type: 'string', length: 255)]
    private $image;

    #[ORM\Column(type: 'object', nullable: true)]
    private $texte;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getTexte()
    {
        return $this->texte;
    }

    public function setTexte($texte): self
    {
        $this->texte = $texte;

        return $this;
    }



}
