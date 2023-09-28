<?php

namespace App\Entity;

use App\Repository\ClasseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClasseRepository::class)]
class Classe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $designation = null;

    #[ORM\OneToMany(mappedBy: 'classe_id', targetEntity: Utilisateur::class)]
    private Collection $utilisateurs;

    #[ORM\OneToMany(mappedBy: 'classe_id', targetEntity: TP::class)]
    private Collection $tPs;

    public function __construct()
    {
        $this->utilisateurs = new ArrayCollection();
        $this->tPs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(string $designation): static
    {
        $this->designation = $designation;

        return $this;
    }

    /**
     * @return Collection<int, Utilisateur>
     */
    public function getUtilisateurs(): Collection
    {
        return $this->utilisateurs;
    }

    public function addUtilisateur(Utilisateur $utilisateur): static
    {
        if (!$this->utilisateurs->contains($utilisateur)) {
            $this->utilisateurs->add($utilisateur);
            $utilisateur->setClasseId($this);
        }

        return $this;
    }

    public function removeUtilisateur(Utilisateur $utilisateur): static
    {
        if ($this->utilisateurs->removeElement($utilisateur)) {
            // set the owning side to null (unless already changed)
            if ($utilisateur->getClasseId() === $this) {
                $utilisateur->setClasseId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, TP>
     */
    public function getTPs(): Collection
    {
        return $this->tPs;
    }

    public function addTP(TP $tP): static
    {
        if (!$this->tPs->contains($tP)) {
            $this->tPs->add($tP);
            $tP->setClasseId($this);
        }

        return $this;
    }

    public function removeTP(TP $tP): static
    {
        if ($this->tPs->removeElement($tP)) {
            // set the owning side to null (unless already changed)
            if ($tP->getClasseId() === $this) {
                $tP->setClasseId(null);
            }
        }

        return $this;
    }
}
