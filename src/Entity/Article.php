<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 */
class Article
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\Column(type="text")
     */
    private $contenu;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateDeCreation;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateDeModiffication;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\ManyToOne(targetEntity=Blogueur::class, inversedBy="articles")
     */
    private $blogueur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getDateDeCreation(): ?\DateTimeInterface
    {
        return $this->dateDeCreation;
    }

    public function setDateDeCreation(\DateTimeInterface $dateDeCreation): self
    {
        $this->dateDeCreation = $dateDeCreation;

        return $this;
    }

    public function getDateDeModiffication(): ?\DateTimeInterface
    {
        return $this->dateDeModiffication;
    }

    public function setDateDeModiffication(?\DateTimeInterface $dateDeModiffication): self
    {
        $this->dateDeModiffication = $dateDeModiffication;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getBlogueur(): ?Blogueur
    {
        return $this->blogueur;
    }

    public function setBlogueur(?Blogueur $blogueur): self
    {
        $this->blogueur = $blogueur;

        return $this;
    }
}
