<?php

namespace App\Entity;

use App\Repository\PoleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PoleRepository::class)]
class Pole
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $LibelleLong = null;

    #[ORM\Column(length: 255)]
    private ?string $LibelleCourt = null;

    #[ORM\Column(nullable: true)]
    private ?bool $Inactif = null;

    #[ORM\ManyToOne(inversedBy: 'poles')]
    private ?Direction $Direction = null;

    #[ORM\OneToOne(mappedBy: 'Pole', cascade: ['persist', 'remove'])]
    private ?SignalPotentiel $signalPotentiel = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelleLong(): ?string
    {
        return $this->LibelleLong;
    }

    public function setLibelleLong(string $LibelleLong): static
    {
        $this->LibelleLong = $LibelleLong;

        return $this;
    }

    public function getLibelleCourt(): ?string
    {
        return $this->LibelleCourt;
    }

    public function setLibelleCourt(string $LibelleCourt): static
    {
        $this->LibelleCourt = $LibelleCourt;

        return $this;
    }

    public function isInactif(): ?bool
    {
        return $this->Inactif;
    }

    public function setInactif(?bool $Inactif): static
    {
        $this->Inactif = $Inactif;

        return $this;
    }

    public function getDirection(): ?Direction
    {
        return $this->Direction;
    }

    public function setDirection(?Direction $Direction): static
    {
        $this->Direction = $Direction;

        return $this;
    }

    public function getSignalPotentiel(): ?SignalPotentiel
    {
        return $this->signalPotentiel;
    }

    public function setSignalPotentiel(?SignalPotentiel $signalPotentiel): static
    {
        // unset the owning side of the relation if necessary
        if ($signalPotentiel === null && $this->signalPotentiel !== null) {
            $this->signalPotentiel->setPole(null);
        }

        // set the owning side of the relation if necessary
        if ($signalPotentiel !== null && $signalPotentiel->getPole() !== $this) {
            $signalPotentiel->setPole($this);
        }

        $this->signalPotentiel = $signalPotentiel;

        return $this;
    }
}
