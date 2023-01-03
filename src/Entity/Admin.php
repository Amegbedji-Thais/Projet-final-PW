<?php

namespace App\Entity;

use App\Repository\AdminRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdminRepository::class)]
#[ORM\Table(name: '`admin`')]
class Admin
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 200)]
    private ?string $Nom_Adm = null;

    #[ORM\Column(length: 200)]
    private ?string $Prenom_Adm = null;

    #[ORM\Column(length: 255)]
    private ?string $Email_Adm = null;

    #[ORM\Column(length: 255)]
    private ?string $Mdp_Adm = null;

    #[ORM\ManyToMany(targetEntity: Bien::class)]
    private Collection $Numero_Bien;

    public function __construct()
    {
        $this->Numero_Bien = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomAdm(): ?string
    {
        return $this->Nom_Adm;
    }

    public function setNomAdm(string $Nom_Adm): self
    {
        $this->Nom_Adm = $Nom_Adm;

        return $this;
    }

    public function getPrenomAdm(): ?string
    {
        return $this->Prenom_Adm;
    }

    public function setPrenomAdm(string $Prenom_Adm): self
    {
        $this->Prenom_Adm = $Prenom_Adm;

        return $this;
    }

    public function getEmailAdm(): ?string
    {
        return $this->Email_Adm;
    }

    public function setEmailAdm(string $Email_Adm): self
    {
        $this->Email_Adm = $Email_Adm;

        return $this;
    }

    public function getMdpAdm(): ?string
    {
        return $this->Mdp_Adm;
    }

    public function setMdpAdm(string $Mdp_Adm): self
    {
        $this->Mdp_Adm = $Mdp_Adm;

        return $this;
    }

    /**
     * @return Collection<int, Bien>
     */
    public function getNumeroBien(): Collection
    {
        return $this->Numero_Bien;
    }

    public function addNumeroBien(Bien $numeroBien): self
    {
        if (!$this->Numero_Bien->contains($numeroBien)) {
            $this->Numero_Bien->add($numeroBien);
        }

        return $this;
    }

    public function removeNumeroBien(Bien $numeroBien): self
    {
        $this->Numero_Bien->removeElement($numeroBien);

        return $this;
    }
}
