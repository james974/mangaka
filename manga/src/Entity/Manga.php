<?php

namespace App\Entity;

use App\Repository\MangaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass=MangaRepository::class)
 */
class Manga
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * 
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom_manga;

  

    /**
     * @ORM\Column(type="integer")
     */
    private $tome;

    /**
     * @ORM\ManyToOne(targetEntity=Magasin::class, inversedBy="mangas")
     */
    private $magasin;

    /**
     * 
     * @ORM\ManyToMany(targetEntity=Auteur::class, inversedBy="manga")
     */
    private $auteur;

   

    public function __construct()
    {
        $this->auteur = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomManga(): ?string
    {
        return $this->nom_manga;
    }

    public function setNomManga(string $nom_manga): self
    {
        $this->nom_manga = $nom_manga;

        return $this;
    }

  

    public function getTome(): ?int
    {
        return $this->tome;
    }

    public function setTome(int $tome): self
    {
        $this->tome = $tome;

        return $this;
    }

    public function getMagasin(): ?Magasin
    {
        return $this->magasin;
    }

    public function setMagasin(?Magasin $magasin): self
    {
        $this->magasin = $magasin;

        return $this;
    }

    /**
     * @return Collection|auteur[]
     */
    public function getAuteur(): Collection
    {
        return $this->auteur;
    }

    public function addAuteur(auteur $auteur): self
    {
        if (!$this->auteur->contains($auteur)) {
            $this->auteur[] = $auteur;
        }

        return $this;
    }

    public function removeAuteur(auteur $auteur): self
    {
        $this->auteur->removeElement($auteur);

        return $this;
    }

    public function __toString()
    {
        return $this->auteur." ".$this->magasin;
    }
}
