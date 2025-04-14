<?php

namespace App\Entity;

use App\Repository\DirectionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DirectionRepository::class)]
class Direction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $LibelleLong = null;

    #[ORM\Column(length: 255)]
    private ?string $LibelleCourt = null;

    /**
     * @var Collection<int, Pole>
     */
    #[ORM\OneToMany(targetEntity: Pole::class, mappedBy: 'Direction')]
    private Collection $poles;

    #[ORM\Column(nullable: true)]
    private ?bool $Inactif = null;

    #[ORM\OneToOne(mappedBy: 'Direction', cascade: ['persist', 'remove'])]
    private ?SignalPotentiel $Pole = null;

    #[ORM\OneToOne(mappedBy: 'Direction', cascade: ['persist', 'remove'])]
    private ?SignalPotentiel $signalPotentiel = null;

    public function __construct()
    {
        $this->poles = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Pole>
     */
    public function getPoles(): Collection
    {
        return $this->poles;
    }

    public function addPole(Pole $pole): static
    {
        if (!$this->poles->contains($pole)) {
            $this->poles->add($pole);
            $pole->setDirection($this);
        }

        return $this;
    }

    public function removePole(Pole $pole): static
    {
        if ($this->poles->removeElement($pole)) {
            // set the owning side to null (unless already changed)
            if ($pole->getDirection() === $this) {
                $pole->setDirection(null);
            }
        }

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

    public function getPole(): ?SignalPotentiel
    {
        return $this->Pole;
    }

    public function setPole(?SignalPotentiel $Pole): static
    {
        // unset the owning side of the relation if necessary
        if ($Pole === null && $this->Pole !== null) {
            $this->Pole->setDirection(null);
        }

        // set the owning side of the relation if necessary
        if ($Pole !== null && $Pole->getDirection() !== $this) {
            $Pole->setDirection($this);
        }

        $this->Pole = $Pole;

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
            $this->signalPotentiel->setDirection(null);
        }

        // set the owning side of the relation if necessary
        if ($signalPotentiel !== null && $signalPotentiel->getDirection() !== $this) {
            $signalPotentiel->setDirection($this);
        }

        $this->signalPotentiel = $signalPotentiel;

        return $this;
    }
}
