<?php

namespace App\Entity;

use App\Repository\AnnoncesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnnoncesRepository::class)]
class Annonces
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $job = null;

    #[ORM\Column(length: 255)]
    private ?string $salairy = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $annonce = null;

    #[ORM\ManyToOne(inversedBy: 'annonces')]
    private ?Recruteur $recruteur = null;

    #[ORM\ManyToOne(inversedBy: 'annonces')]
    private ?User $user = null;

    #[ORM\OneToMany(mappedBy: 'annonce', targetEntity: Candidacy::class)]
    private Collection $candidacies;

    #[ORM\Column(nullable: true)]
    private ?bool $isApproved = null;

    #[ORM\Column(length: 255)]
    private ?string $Locality = null;

    #[ORM\Column(length: 255)]
    private ?string $schedules = null;

    public function __construct()
    {
        $this->candidacies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJob(): ?string
    {
        return $this->job;
    }

    public function setJob(string $job): self
    {
        $this->job = $job;

        return $this;
    }

    public function getSalairy(): ?string
    {
        return $this->salairy;
    }

    public function setSalairy(string $salairy): self
    {
        $this->salairy = $salairy;

        return $this;
    }

    public function getAnnonce(): ?string
    {
        return $this->annonce;
    }

    public function setAnnonce(string $annonce): self
    {
        $this->annonce = $annonce;

        return $this;
    }

    public function getRecruteur(): ?Recruteur
    {
        return $this->recruteur;
    }

    public function setRecruteur(?Recruteur $recruteur): self
    {
        $this->recruteur = $recruteur;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function isIsApproved(): ?bool
    {
        return $this->isApproved;
    }

    public function setIsApproved(?bool $isApproved): self
    {
        $this->isApproved = $isApproved;

        return $this;
    }

    public function getLocality(): ?string
    {
        return $this->Locality;
    }

    public function setLocality(string $Locality): self
    {
        $this->Locality = $Locality;

        return $this;
    }

    public function getSchedules(): ?string
    {
        return $this->schedules;
    }

    public function setSchedules(string $schedules): self
    {
        $this->schedules = $schedules;

        return $this;
    }
}
