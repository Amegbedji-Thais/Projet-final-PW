<?php

namespace App\Entity;

use App\Repository\FavoriRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FavoriRepository::class)]
class Favori
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Email_Fav = null;

    #[ORM\ManyToMany(targetEntity: Bien::class, inversedBy: 'id_Fav')]
    private Collection $Numero_Bien;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $Date_Fav = null;

    public function __construct()
    {
        $this->Numero_Bien = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmailFav(): ?string
    {
        return $this->Email_Fav;
    }

    public function setEmailFav(string $Email_Fav): self
    {
        $this->Email_Fav = $Email_Fav;

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

    public function getDateFav(): ?\DateTimeInterface
    {
        return $this->Date_Fav;
    }

    public function setDateFav(\DateTimeInterface $Date_Fav): self
    {
        $this->Date_Fav = $Date_Fav;

        return $this;
    }
}
