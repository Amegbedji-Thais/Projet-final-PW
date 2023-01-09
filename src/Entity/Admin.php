<?php

namespace App\Entity;

use App\Repository\AdminRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdminRepository::class)]
#[UniqueEntity(fields: ['email_adm'], message: 'Un compte existe dejà avec cette adresse email')]
class Admin implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_adm = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom_adm = null;

    #[ORM\Column(length: 255, unique: true)]
    private ?string $email_adm = null;

    #[ORM\Column(length: 255)]
    private ?string $mdp_adm = null;

    #[ORM\ManyToMany(targetEntity: Biens::class, inversedBy: 'adm_id')]
    private Collection $bien_id;

    #[ORM\Column(length: 60)]
    private ?string $roles = null;

    public function __construct()
    {
        $this->bien_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getNomAdm(): ?string
    {
        return $this->nom_adm;
    }

    public function setNomAdm(string $nom_adm): self
    {
        $this->nom_adm = $nom_adm;

        return $this;
    }

    public function getPrenomAdm(): ?string
    {
        return $this->prenom_adm;
    }

    public function setPrenomAdm(string $prenom_adm): self
    {
        $this->prenom_adm = $prenom_adm;

        return $this;
    }

    public function getEmailAdm(): ?string
    {
        return $this->email_adm;
    }

    public function setEmailAdm(string $email_adm): self
    {
        $this->email_adm = $email_adm;

        return $this;
    }

    public function getMdpAdm(): ?string
    {
        return $this->mdp_adm;
    }

    public function setMdpAdm(string $mdp_adm): self
    {
        $this->mdp_adm = $mdp_adm;

        return $this;
    }

    public function getRoles(): array
    {
        return ['ROLE_ADMIN'];
    }

    public function setRoles(string $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getUserIdentifier(): string
    {
        return "";// TODO: Implement getUserIdentifier() method.
    }

    /**
     * @return Collection<int, biens>
     */
    public function getBienId(): Collection
    {
        return $this->bien_id;
    }

    public function addBienId(biens $bienId): self
    {
        if (!$this->bien_id->contains($bienId)) {
            $this->bien_id->add($bienId);
        }

        return $this;
    }

    public function removeBienId(biens $bienId): self
    {
        $this->bien_id->removeElement($bienId);

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->mdp_adm; // TODO: Implement getPassword() method.
    }
}
