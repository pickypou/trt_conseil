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
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $job = null;

    #[ORM\Column(length: 255)]
    private ?string $salary = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $announcement = null;

    #[ORM\ManyToMany(targetEntity: Candidat::class, inversedBy: 'annonces')]
    private Collection $candidat;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'annonces')]
    private ?self $recruteur = null;

    #[ORM\OneToMany(mappedBy: 'recruteur', targetEntity: self::class)]
    private Collection $annonces;

    public function __construct()
    {
        $this->candidat = new ArrayCollection();
        $this->annonces = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
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

    public function getSalary(): ?string
    {
        return $this->salary;
    }

    public function setSalary(string $salary): self
    {
        $this->salary = $salary;

        return $this;
    }

    public function getAnnouncement(): ?string
    {
        return $this->announcement;
    }

    public function setAnnouncement(string $announcement): self
    {
        $this->announcement = $announcement;

        return $this;
    }

    /**
     * @return Collection<int, Candidat>
     */
    public function getCandidat(): Collection
    {
        return $this->candidat;
    }

    public function addCandidat(Candidat $candidat): self
    {
        if (!$this->candidat->contains($candidat)) {
            $this->candidat->add($candidat);
        }

        return $this;
    }

    public function removeCandidat(Candidat $candidat): self
    {
        $this->candidat->removeElement($candidat);

        return $this;
    }

    public function getRecruteur(): ?self
    {
        return $this->recruteur;
    }

    public function setRecruteur(?self $recruteur): self
    {
        $this->recruteur = $recruteur;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getAnnonces(): Collection
    {
        return $this->annonces;
    }

    public function addAnnonce(self $annonce): self
    {
        if (!$this->annonces->contains($annonce)) {
            $this->annonces->add($annonce);
            $annonce->setRecruteur($this);
        }

        return $this;
    }

    public function removeAnnonce(self $annonce): self
    {
        if ($this->annonces->removeElement($annonce)) {
            // set the owning side to null (unless already changed)
            if ($annonce->getRecruteur() === $this) {
                $annonce->setRecruteur(null);
            }
        }

        return $this;
    }
}
