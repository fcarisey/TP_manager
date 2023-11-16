<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
class Utilisateur implements PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups("utilisateur")]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups("utilisateur")]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    #[Groups("utilisateur")]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    #[Groups("utilisateur")]
    private ?string $mot_de_passe = null;

    #[ORM\Column(length: 255)]
    #[Groups("utilisateur")]
    private ?string $courriel = null;

    #[ORM\ManyToOne(inversedBy: 'utilisateurs')]
    #[Groups("utilisateur_classe")]
    private ?Classe $classe = null;

    #[ORM\Column(length: 50)]
    #[Groups("utilisateur")]
    private ?string $role = null;

    #[ORM\OneToMany(mappedBy: 'utilisateur', targetEntity: TacheUtilisateur::class, orphanRemoval: true)]
    #[Groups("utilisateur_tache")]
    private Collection $tacheUtilisateurs;

    public function __construct()
    {
        $this->tacheUtilisateurs = new ArrayCollection();
        $this->password = $this->getPassword();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getMotDePasse(): ?string
    {
        return $this->mot_de_passe;
    }

    public function setMotDePasse(string $mot_de_passe): static
    {
        $this->mot_de_passe = $mot_de_passe;

        return $this;
    }

    public function getCourriel(): ?string
    {
        return $this->courriel;
    }

    public function setCourriel(string $courriel): static
    {
        $this->courriel = $courriel;

        return $this;
    }

    public function getClasse(): ?Classe
    {
        return $this->classe;
    }

    public function setClasse(?Classe $classe): static
    {
        $this->classe = $classe;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): static
    {
        $this->role = $role;

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
            $tacheUtilisateur->setUtilisateur($this);
        }

        return $this;
    }

    public function removeTacheUtilisateur(TacheUtilisateur $tacheUtilisateur): static
    {
        if ($this->tacheUtilisateurs->removeElement($tacheUtilisateur)) {
            // set the owning side to null (unless already changed)
            if ($tacheUtilisateur->getUtilisateur() === $this) {
                $tacheUtilisateur->setUtilisateur(null);
            }
        }

        return $this;
    }

    public function setPassword(string $password): static
    {
        $this->mot_de_passe = $password;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->mot_de_passe;
    }

    public function __toString(): string{
        return "qershtdyuyitluyu";
    }
}
