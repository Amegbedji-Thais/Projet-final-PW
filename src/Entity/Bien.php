<?php

namespace App\Entity;

use App\Repository\BienRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BienRepository::class)]
class Bien
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 1)]
    private ?string $Type_Bien = null;

    #[ORM\Column(length: 255)]
    private ?string $Titre_Bien = null;

    #[ORM\Column]
    private ?int $Surface_Bien = null;

    #[ORM\Column]
    private ?float $Prix_Bien = null;

    #[ORM\Column(length: 255)]
    private ?string $Localisation_Bien = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $Description_Bien = null;

    #[ORM\ManyToOne(inversedBy: 'id_Bien')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Categorie $id_Cat = null;

    #[ORM\ManyToMany(targetEntity: Favori::class, mappedBy: 'Numero_Bien')]
    private Collection $id_Fav;

    public function __construct()
    {
        $this->id_Fav = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeBien(): ?string
    {
        return $this->Type_Bien;
    }

    public function setTypeBien(string $Type_Bien): self
    {
        $this->Type_Bien = $Type_Bien;

        return $this;
    }

    public function getTitreBien(): ?string
    {
        return $this->Titre_Bien;
    }

    public function setTitreBien(string $Titre_Bien): self
    {
        $this->Titre_Bien = $Titre_Bien;

        return $this;
    }

    public function getSurfaceBien(): ?int
    {
        return $this->Surface_Bien;
    }

    public function setSurfaceBien(int $Surface_Bien): self
    {
        $this->Surface_Bien = $Surface_Bien;

        return $this;
    }

    public function getPrixBien(): ?float
    {
        return $this->Prix_Bien;
    }

    public function setPrixBien(float $Prix_Bien): self
    {
        $this->Prix_Bien = $Prix_Bien;

        return $this;
    }

    public function getLocalisationBien(): ?string
    {
        return $this->Localisation_Bien;
    }

    public function setLocalisationBien(string $Localisation_Bien): self
    {
        $this->Localisation_Bien = $Localisation_Bien;

        return $this;
    }

    public function getDescriptionBien(): ?string
    {
        return $this->Description_Bien;
    }

    public function setDescriptionBien(?string $Description_Bien): self
    {
        $this->Description_Bien = $Description_Bien;

        return $this;
    }

    public function getIdCat(): ?Categorie
    {
        return $this->id_Cat;
    }

    public function setIdCat(?Categorie $id_Cat): self
    {
        $this->id_Cat = $id_Cat;

        return $this;
    }

    /**
     * @return Collection<int, Favori>
     */
    public function getIdFav(): Collection
    {
        return $this->id_Fav;
    }

    public function addIdFav(Favori $idFav): self
    {
        if (!$this->id_Fav->contains($idFav)) {
            $this->id_Fav->add($idFav);
            $idFav->addNumeroBien($this);
        }

        return $this;
    }

    public function removeIdFav(Favori $idFav): self
    {
        if ($this->id_Fav->removeElement($idFav)) {
            $idFav->removeNumeroBien($this);
        }

        return $this;
    }
}
