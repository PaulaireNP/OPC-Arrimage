<?php

namespace App\Entity;

use App\Repository\FicheSuiviRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FicheSuiviRepository::class)]
class FicheSuivi
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $rencontre = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $creationDate = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $echange = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $orientation = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $echeance = null;

    #[ORM\ManyToOne(inversedBy: 'fichesSuivi')]
    private ?Jeune $jeune = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRencontre(): ?int
    {
        return $this->rencontre;
    }

    public function setRencontre(int $rencontre): static
    {
        $this->rencontre = $rencontre;

        return $this;
    }

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creationDate;
    }

    public function setCreationDate(\DateTimeInterface $creationDate): static
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    public function getEchange(): ?string
    {
        return $this->echange;
    }

    public function setEchange(string $echange): static
    {
        $this->echange = $echange;

        return $this;
    }

    public function getOrientation(): ?string
    {
        return $this->orientation;
    }

    public function setOrientation(string $orientation): static
    {
        $this->orientation = $orientation;

        return $this;
    }

    public function getEcheance(): ?\DateTimeInterface
    {
        return $this->echeance;
    }

    public function setEcheance(\DateTimeInterface $echeance): static
    {
        $this->echeance = $echeance;

        return $this;
    }

    public function getJeune(): ?Jeune
    {
        return $this->jeune;
    }

    public function setJeune(?Jeune $jeune): static
    {
        $this->jeune = $jeune;

        return $this;
    }
}
