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

    #[ORM\Column(length: 255)]
    private ?string $designation = null;

    #[ORM\OneToMany(mappedBy: 'classe', targetEntity: Utilisateur::class)]
    private Collection $utilisateurs;

    #[ORM\OneToMany(mappedBy: 'classe', targetEntity: Tp::class)]
    private Collection $tps;

    public function __construct()
    {
        $this->utilisateurs = new ArrayCollection();
        $this->tps = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
            $utilisateur->setClasse($this);
        }

        return $this;
    }

    public function removeUtilisateur(Utilisateur $utilisateur): static
    {
        if ($this->utilisateurs->removeElement($utilisateur)) {
            // set the owning side to null (unless already changed)
            if ($utilisateur->getClasse() === $this) {
                $utilisateur->setClasse(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Tp>
     */
    public function getTps(): Collection
    {
        return $this->tps;
    }

    public function addTp(Tp $tp): static
    {
        if (!$this->tps->contains($tp)) {
            $this->tps->add($tp);
            $tp->setClasse($this);
        }

        return $this;
    }

    public function removeTp(Tp $tp): static
    {
        if ($this->tps->removeElement($tp)) {
            // set the owning side to null (unless already changed)
            if ($tp->getClasse() === $this) {
                $tp->setClasse(null);
            }
        }

        return $this;
    }
}
