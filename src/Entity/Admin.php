<?php

namespace App\Entity;

use App\Repository\AdminRepository;
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

    public function getPassword(): ?string
    {
        // TODO: Implement getPassword() method.
    }

    public function getRoles(): array
    {
        // TODO: Implement getRoles() method.
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getUserIdentifier(): string
    {
        // TODO: Implement getUserIdentifier() method.
    }
}
