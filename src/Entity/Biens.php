<?php

namespace App\Entity;

use App\Repository\BiensRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BiensRepository::class)]
class Biens
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $type_bien = null;

    #[ORM\Column(length: 255)]
    private ?string $titre_bien = null;

    #[ORM\Column(length: 255)]
    private ?string $surface_bien = null;

    #[ORM\Column]
    private ?int $prix_bien = null;

    #[ORM\Column(length: 255)]
    private ?string $localisation_bien = null;

    #[ORM\Column(length: 255)]
    private ?string $description_bien = null;

    #[ORM\ManyToOne(inversedBy: 'biens')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Categories $categorie = null;

    #[ORM\OneToMany(mappedBy: 'bien', targetEntity: Favoris::class, orphanRemoval: true)]
    private Collection $favoris;

    public function __construct()
    {
        $this->favoris = new ArrayCollection();
    }
    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeBien(): ?string
    {
        return $this->type_bien;
    }

    public function setTypeBien(string $type_bien): self
    {
        $this->type_bien = $type_bien;

        return $this;
    }

    public function getTitreBien(): ?string
    {
        return $this->titre_bien;
    }

    public function setTitreBien(string $titre_bien): self
    {
        $this->titre_bien = $titre_bien;

        return $this;
    }

    public function getSurfaceBien(): ?string
    {
        return $this->surface_bien;
    }

    public function setSurfaceBien(string $surface_bien): self
    {
        $this->surface_bien = $surface_bien;

        return $this;
    }

    public function getPrixBien(): ?int
    {
        return $this->prix_bien;
    }

    public function setPrixBien(int $prix_bien): self
    {
        $this->prix_bien = $prix_bien;

        return $this;
    }

    public function getLocalisationBien(): ?string
    {
        return $this->localisation_bien;
    }

    public function setLocalisationBien(string $localisation_bien): self
    {
        $this->localisation_bien = $localisation_bien;

        return $this;
    }

    public function getDescriptionBien(): ?string
    {
        return $this->description_bien;
    }

    public function setDescriptionBien(string $description_bien): self
    {
        $this->description_bien = $description_bien;

        return $this;
    }

    public function getCategorie(): ?Categories
    {
        return $this->categorie;
    }

    public function setCategorie(?Categories $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * @return Collection<int, Favoris>
     */
    public function getFavoris(): Collection
    {
        return $this->favoris;
    }

    public function addFavori(Favoris $favori): self
    {
        if (!$this->favoris->contains($favori)) {
            $this->favoris->add($favori);
            $favori->setBien($this);
        }

        return $this;
    }

    public function removeFavori(Favoris $favori): self
    {
        if ($this->favoris->removeElement($favori)) {
            // set the owning side to null (unless already changed)
            if ($favori->getBien() === $this) {
                $favori->setBien(null);
            }
        }

        return $this;
    }


}
