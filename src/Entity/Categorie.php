<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 80)]
    private ?string $Titre_Cat = null;

    #[ORM\OneToMany(mappedBy: 'id_Cat', targetEntity: Bien::class, orphanRemoval: true)]
    private Collection $id_Bien;

    public function __construct()
    {
        $this->id_Bien = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setIdCat(int $id_Cat): self
    {
        $this->id_Cat = $id_Cat;

        return $this;
    }

    public function getTitreCat(): ?string
    {
        return $this->Titre_Cat;
    }

    public function setTitreCat(string $Titre_Cat): self
    {
        $this->Titre_Cat = $Titre_Cat;

        return $this;
    }

    /**
     * @return Collection<int, Bien>
     */
    public function getIdBien(): Collection
    {
        return $this->id_Bien;
    }

    public function addIdBien(Bien $idBien): self
    {
        if (!$this->id_Bien->contains($idBien)) {
            $this->id_Bien->add($idBien);
            $idBien->setIdCat($this);
        }

        return $this;
    }

    public function removeIdBien(Bien $idBien): self
    {
        if ($this->id_Bien->removeElement($idBien)) {
            // set the owning side to null (unless already changed)
            if ($idBien->getIdCat() === $this) {
                $idBien->setIdCat(null);
            }
        }

        return $this;
    }
}
