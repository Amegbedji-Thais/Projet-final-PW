<?php

namespace App\Entity;

use App\Repository\CategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoriesRepository::class)]
class Categories
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'categorie', targetEntity: Biens::class, orphanRemoval: true)]
    private Collection $biens;

    #[ORM\Column(length: 255)]
    private ?string $titre_cat = null;

    public function __construct()
    {
        $this->biens = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }


    public function setEmailFav(string $email_fav): self
    {
        $this->email_fav = $email_fav;

        return $this;
    }

    /**
     * @return Collection<int, Biens>
     */
    public function getBiens(): Collection
    {
        return $this->biens;
    }

    public function addBien(Biens $bien): self
    {
        if (!$this->biens->contains($bien)) {
            $this->biens->add($bien);
            $bien->setCategorie($this);
        }

        return $this;
    }

    public function removeBien(Biens $bien): self
    {
        if ($this->biens->removeElement($bien)) {
            // set the owning side to null (unless already changed)
            if ($bien->getCategorie() === $this) {
                $bien->setCategorie(null);
            }
        }

        return $this;
    }

    public function getTitreCat(): ?string
    {
        return $this->titre_cat;
    }

    public function setTitreCat(string $titre_cat): self
    {
        $this->titre_cat = $titre_cat;

        return $this;
    }
}
