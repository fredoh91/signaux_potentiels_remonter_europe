<?php

namespace App\Entity;

use App\Repository\VoieAdminRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VoieAdminRepository::class)]
class VoieAdmin
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Libelle = null;

    #[ORM\Column]
    private ?bool $Inactif = null;

    /**
     * @var Collection<int, SignalPotentiel>
     */
    #[ORM\OneToMany(targetEntity: SignalPotentiel::class, mappedBy: 'voieAdmin')]
    private Collection $SignalPotentiel;

    #[ORM\Column]
    private ?int $codeTerme = null;

    #[ORM\Column(nullable: true)]
    private ?int $codeTermePere = null;

    #[ORM\Column(nullable: true)]
    private ?int $OrdreAffichage = null;

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
            $signalPotentiel->setVoieAdmin($this);
        }

        return $this;
    }

    public function removeSignalPotentiel(SignalPotentiel $signalPotentiel): static
    {
        if ($this->SignalPotentiel->removeElement($signalPotentiel)) {
            // set the owning side to null (unless already changed)
            if ($signalPotentiel->getVoieAdmin() === $this) {
                $signalPotentiel->setVoieAdmin(null);
            }
        }

        return $this;
    }

    public function getCodeTerme(): ?int
    {
        return $this->codeTerme;
    }

    public function setCodeTerme(int $codeTerme): static
    {
        $this->codeTerme = $codeTerme;

        return $this;
    }

    public function getCodeTermePere(): ?int
    {
        return $this->codeTermePere;
    }

    public function setCodeTermePere(?int $codeTermePere): static
    {
        $this->codeTermePere = $codeTermePere;

        return $this;
    }

    public function getOrdreAffichage(): ?int
    {
        return $this->OrdreAffichage;
    }

    public function setOrdreAffichage(?int $OrdreAffichage): static
    {
        $this->OrdreAffichage = $OrdreAffichage;

        return $this;
    }
}
