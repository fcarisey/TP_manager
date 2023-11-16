<?php

namespace App\Entity;

use App\Repository\TacheRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TacheRepository::class)]
class Tache
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $ordre = null;

    #[ORM\Column]
    private ?int $point = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'taches')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Tp $tp = null;

    #[ORM\OneToMany(mappedBy: 'tache', targetEntity: TacheUtilisateur::class, orphanRemoval: true)]
    private Collection $tacheUtilisateurs;

    public function __construct()
    {
        $this->tacheUtilisateurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrdre(): ?int
    {
        return $this->ordre;
    }

    public function setOrdre(int $ordre): static
    {
        $this->ordre = $ordre;

        return $this;
    }

    public function getPoint(): ?int
    {
        return $this->point;
    }

    public function setPoint(int $point): static
    {
        $this->point = $point;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getTp(): ?Tp
    {
        return $this->tp;
    }

    public function setTp(?Tp $tp): static
    {
        $this->tp = $tp;

        return $this;
    }

    /**
     * @return Collection<int, TacheUtilisateur>
     */
    public function getTacheUtilisateurs(): Collection
    {
        return $this->tacheUtilisateurs;
    }

    public function addTacheUtilisateur(TacheUtilisateur $tacheUtilisateur): static
    {
        if (!$this->tacheUtilisateurs->contains($tacheUtilisateur)) {
            $this->tacheUtilisateurs->add($tacheUtilisateur);
            $tacheUtilisateur->setTache($this);
        }

        return $this;
    }

    public function removeTacheUtilisateur(TacheUtilisateur $tacheUtilisateur): static
    {
        if ($this->tacheUtilisateurs->removeElement($tacheUtilisateur)) {
            // set the owning side to null (unless already changed)
            if ($tacheUtilisateur->getTache() === $this) {
                $tacheUtilisateur->setTache(null);
            }
        }

        return $this;
    }
}
