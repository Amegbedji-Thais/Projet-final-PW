<?php

namespace App\Entity;

use App\Repository\FavorisRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FavorisRepository::class)]
class Favoris
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $mail_fav = null;

    #[ORM\Column]
    private ?bool $send = null;

    #[ORM\ManyToMany(targetEntity: biens::class, inversedBy: 'favori_id')]
    private Collection $bien_id;

    public function __construct()
    {
        $this->bien_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMailFav(): ?string
    {
        return $this->mail_fav;
    }

    public function setMailFav(string $mail_fav): self
    {
        $this->mail_fav = $mail_fav;

        return $this;
    }

    public function getBien(): ?Biens
    {
        return $this->bien;
    }

    public function setBien(?Biens $bien): self
    {
        $this->bien = $bien;

        return $this;
    }

    public function isSend(): ?bool
    {
        return $this->send;
    }

    public function setSend(bool $send): self
    {
        $this->send = $send;

        return $this;
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

}
