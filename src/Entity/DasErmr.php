<?php

namespace App\Entity;

use App\Repository\DasErmrRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DasErmrRepository::class)]
class DasErmr
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Libelle = null;

    #[ORM\Column]
    private ?int $Score = null;

    #[ORM\Column]
    private ?bool $Inactif = null;

    /**
     * @var Collection<int, SignalPotentiel>
     */
    #[ORM\OneToMany(targetEntity: SignalPotentiel::class, mappedBy: 'dasErmr')]
    private Collection $SignalPotentiel;

    public function __construct()
    {
        $this->SignalPotentiel = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->Libelle;
    }

    public function setLibelle(string $Libelle): static
    {
        $this->Libelle = $Libelle;

        return $this;
    }

    public function getScore(): ?int
    {
        return $this->Score;
    }

    public function setScore(int $Score): static
    {
        $this->Score = $Score;

        return $this;
    }

    public function isInactif(): ?bool
    {
        return $this->Inactif;
    }

    public function setInactif(bool $Inactif): static
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
            $signalPotentiel->setDasErmr($this);
        }

        return $this;
    }

    public function removeSignalPotentiel(SignalPotentiel $signalPotentiel): static
    {
        if ($this->SignalPotentiel->removeElement($signalPotentiel)) {
            // set the owning side to null (unless already changed)
            if ($signalPotentiel->getDasErmr() === $this) {
                $signalPotentiel->setDasErmr(null);
            }
        }

        return $this;
    }
}
