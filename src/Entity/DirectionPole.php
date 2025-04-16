<?php

namespace App\Entity;

use App\Repository\DirectionPoleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DirectionPoleRepository::class)]
class DirectionPole
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $LibelleDmmLong = null;

    #[ORM\Column(length: 255)]
    private ?string $LibelleDmmCourt = null;

    #[ORM\Column(length: 255)]
    private ?string $LibellePoleLong = null;

    #[ORM\Column(length: 255)]
    private ?string $LibellePoleCourt = null;

    #[ORM\Column(nullable: true)]
    private ?bool $Inactif = null;

    /**
     * @var Collection<int, SignalPotentiel>
     */
    #[ORM\OneToMany(targetEntity: SignalPotentiel::class, mappedBy: 'directionPole')]
    private Collection $SignalPotentiel;

    public function __construct()
    {
        $this->SignalPotentiel = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelleDmmLong(): ?string
    {
        return $this->LibelleDmmLong;
    }

    public function setLibelleDmmLong(string $LibelleDmmLong): static
    {
        $this->LibelleDmmLong = $LibelleDmmLong;

        return $this;
    }

    public function getLibelleDmmCourt(): ?string
    {
        return $this->LibelleDmmCourt;
    }

    public function setLibelleDmmCourt(string $LibelleDmmCourt): static
    {
        $this->LibelleDmmCourt = $LibelleDmmCourt;

        return $this;
    }

    public function getLibellePoleLong(): ?string
    {
        return $this->LibellePoleLong;
    }

    public function setLibellePoleLong(string $LibellePoleLong): static
    {
        $this->LibellePoleLong = $LibellePoleLong;

        return $this;
    }

    public function getLibellePoleCourt(): ?string
    {
        return $this->LibellePoleCourt;
    }

    public function setLibellePoleCourt(string $LibellePoleCourt): static
    {
        $this->LibellePoleCourt = $LibellePoleCourt;

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

    /**
     * @return Collection<int, SignalPotentiel>
     */
    public function getSignalPotentiel(): Collection
    {
        return $this->SignalPotentiel;
    }

    public function addSignalPotentiel(SignalPotentiel $signalPotentiel): static
    {
        if (!$this->SignalPotentiel->contains($signalPotentiel)) {
            $this->SignalPotentiel->add($signalPotentiel);
            $signalPotentiel->setDirectionPole($this);
        }

        return $this;
    }

    public function removeSignalPotentiel(SignalPotentiel $signalPotentiel): static
    {
        if ($this->SignalPotentiel->removeElement($signalPotentiel)) {
            // set the owning side to null (unless already changed)
            if ($signalPotentiel->getDirectionPole() === $this) {
                $signalPotentiel->setDirectionPole(null);
            }
        }

        return $this;
    }
}
