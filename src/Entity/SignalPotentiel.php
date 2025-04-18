<?php

namespace App\Entity;

use App\Repository\SignalPotentielRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: SignalPotentielRepository::class)]
class SignalPotentiel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $DMM = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $PoleLong = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $PoleCourt = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\NotBlank(message:'Le champ nom est obligatoire.')]
    private ?string $EvalNom = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\NotBlank(message:'Le champ prénom est obligatoire.')]
    private ?string $EvalPrenom = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\NotBlank]
    private ?string $Substance = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Dosage = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $SignalPotentiel = null;

    #[ORM\Column(length: 1000, nullable: true)]
    private ?string $OrigineSignal = null;

    #[ORM\Column(nullable: true)]
    private ?int $Score = null;

    #[ORM\Column(length: 1000, nullable: true)]
    private ?string $Commentaire = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $userCreate = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $userModif = null;

    #[ORM\OneToOne(inversedBy: 'signalPotentiel', cascade: ['persist', 'remove'])]
    private ?Direction $Direction = null;

    #[ORM\OneToOne(inversedBy: 'signalPotentiel', cascade: ['persist', 'remove'])]
    private ?Pole $Pole = null;

    #[ORM\ManyToOne(inversedBy: 'SignalPotentiel')]
    private ?MecanismeAction $mecanismeAction = null;

    #[ORM\ManyToOne(inversedBy: 'SignalPotentiel')]
    private ?Exposition $exposition = null;

    #[ORM\ManyToOne(inversedBy: 'SignalPotentiel')]
    private ?Imputabilite $imputabilite = null;

    #[ORM\ManyToOne(inversedBy: 'SignalPotentiel')]
    private ?Litterature $litterature = null;

    #[ORM\ManyToOne(inversedBy: 'SignalPotentiel')]
    private ?EssaisCliniques $essaisCliniques = null;

    #[ORM\ManyToOne(inversedBy: 'SignalPotentiel')]
    private ?EffetRCPautrePays $effetRCPautrePays = null;

    #[ORM\ManyToOne(inversedBy: 'SignalPotentiel')]
    private ?DasErmr $dasErmr = null;

    #[ORM\ManyToOne(inversedBy: 'SignalPotentiel')]
    private ?VoieAdmin $voieAdmin = null;

    #[ORM\ManyToOne(inversedBy: 'SignalPotentiel')]
    #[Assert\NotBlank(message:'Le champ Direction-Pôle est obligatoire.')]
    private ?DirectionPole $directionPole = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Specialite = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDMM(): ?string
    {
        return $this->DMM;
    }

    public function setDMM(?string $DMM): static
    {
        $this->DMM = $DMM;

        return $this;
    }

    public function getPoleLong(): ?string
    {
        return $this->PoleLong;
    }

    public function setPoleLong(?string $PoleLong): static
    {
        $this->PoleLong = $PoleLong;

        return $this;
    }

    public function getPoleCourt(): ?string
    {
        return $this->PoleCourt;
    }

    public function setPoleCourt(?string $PoleCourt): static
    {
        $this->PoleCourt = $PoleCourt;

        return $this;
    }

    public function getEvalNom(): ?string
    {
        return $this->EvalNom;
    }

    public function setEvalNom(?string $EvalNom): static
    {
        $this->EvalNom = $EvalNom;

        return $this;
    }

    public function getEvalPrenom(): ?string
    {
        return $this->EvalPrenom;
    }

    public function setEvalPrenom(?string $EvalPrenom): static
    {
        $this->EvalPrenom = $EvalPrenom;

        return $this;
    }

    public function getSubstance(): ?string
    {
        return $this->Substance;
    }

    public function setSubstance(?string $Substance): static
    {
        $this->Substance = $Substance;

        return $this;
    }

    public function getDosage(): ?string
    {
        return $this->Dosage;
    }

    public function setDosage(?string $Dosage): static
    {
        $this->Dosage = $Dosage;

        return $this;
    }

    // public function getVoieAdmin(): ?string
    // {
    //     return $this->VoieAdmin;
    // }

    // public function setVoieAdmin(?string $VoieAdmin): static
    // {
    //     $this->VoieAdmin = $VoieAdmin;

    //     return $this;
    // }

    public function getSignalPotentiel(): ?string
    {
        return $this->SignalPotentiel;
    }

    public function setSignalPotentiel(?string $SignalPotentiel): static
    {
        $this->SignalPotentiel = $SignalPotentiel;

        return $this;
    }

    public function getOrigineSignal(): ?string
    {
        return $this->OrigineSignal;
    }

    public function setOrigineSignal(?string $OrigineSignal): static
    {
        $this->OrigineSignal = $OrigineSignal;

        return $this;
    }

    public function getScore(): ?int
    {
        return $this->Score;
    }

    public function setScore(?int $Score): static
    {
        $this->Score = $Score;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->Commentaire;
    }

    public function setCommentaire(?string $Commentaire): static
    {
        $this->Commentaire = $Commentaire;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getUserCreate(): ?string
    {
        return $this->userCreate;
    }

    public function setUserCreate(?string $userCreate): static
    {
        $this->userCreate = $userCreate;

        return $this;
    }

    public function getUserModif(): ?string
    {
        return $this->userModif;
    }

    public function setUserModif(?string $userModif): static
    {
        $this->userModif = $userModif;

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

    public function getPole(): ?Pole
    {
        return $this->Pole;
    }

    public function setPole(?Pole $Pole): static
    {
        $this->Pole = $Pole;

        return $this;
    }

    public function getMecanismeAction(): ?MecanismeAction
    {
        return $this->mecanismeAction;
    }

    public function setMecanismeAction(?MecanismeAction $mecanismeAction): static
    {
        $this->mecanismeAction = $mecanismeAction;

        return $this;
    }

    public function getExposition(): ?Exposition
    {
        return $this->exposition;
    }

    public function setExposition(?Exposition $exposition): static
    {
        $this->exposition = $exposition;

        return $this;
    }

    public function getImputabilite(): ?Imputabilite
    {
        return $this->imputabilite;
    }

    public function setImputabilite(?Imputabilite $imputabilite): static
    {
        $this->imputabilite = $imputabilite;

        return $this;
    }

    public function getLitterature(): ?Litterature
    {
        return $this->litterature;
    }

    public function setLitterature(?Litterature $litterature): static
    {
        $this->litterature = $litterature;

        return $this;
    }

    public function getEssaisCliniques(): ?EssaisCliniques
    {
        return $this->essaisCliniques;
    }

    public function setEssaisCliniques(?EssaisCliniques $essaisCliniques): static
    {
        $this->essaisCliniques = $essaisCliniques;

        return $this;
    }

    public function getEffetRCPautrePays(): ?EffetRCPautrePays
    {
        return $this->effetRCPautrePays;
    }

    public function setEffetRCPautrePays(?EffetRCPautrePays $effetRCPautrePays): static
    {
        $this->effetRCPautrePays = $effetRCPautrePays;

        return $this;
    }

    public function getDasErmr(): ?DasErmr
    {
        return $this->dasErmr;
    }

    public function setDasErmr(?DasErmr $dasErmr): static
    {
        $this->dasErmr = $dasErmr;

        return $this;
    }

    public function getVoieAdmin(): ?VoieAdmin
    {
        return $this->voieAdmin;
    }

    public function setVoieAdmin(?VoieAdmin $voieAdmin): static
    {
        $this->voieAdmin = $voieAdmin;

        return $this;
    }

    public function getDirectionPole(): ?DirectionPole
    {
        return $this->directionPole;
    }

    public function setDirectionPole(?DirectionPole $directionPole): static
    {
        $this->directionPole = $directionPole;

        return $this;
    }

    public function getSpecialite(): ?string
    {
        return $this->Specialite;
    }

    public function setSpecialite(?string $Specialite): static
    {
        $this->Specialite = $Specialite;

        return $this;
    }
}
