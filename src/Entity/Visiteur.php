<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VisiteurRepository")
 */
class Visiteur
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $matricule;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $Nom_vis;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse_vis;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $CP_vis;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Ville_vis;

    /**
     * @ORM\Column(type="date")
     */
    private $dateEmbauche_vis;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Departement", inversedBy="visiteurs")
     */
    private $ledepartement;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Secteur", inversedBy="visiteurs")
     */
    private $lesecteur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(string $matricule): self
    {
        $this->matricule = $matricule;

        return $this;
    }

    public function getNomVis(): ?string
    {
        return $this->Nom_vis;
    }

    public function setNomVis(string $Nom_vis): self
    {
        $this->Nom_vis = $Nom_vis;

        return $this;
    }

    public function getAdresseVis(): ?string
    {
        return $this->adresse_vis;
    }

    public function setAdresseVis(string $adresse_vis): self
    {
        $this->adresse_vis = $adresse_vis;

        return $this;
    }

    public function getCPVis(): ?string
    {
        return $this->CP_vis;
    }

    public function setCPVis(string $CP_vis): self
    {
        $this->CP_vis = $CP_vis;

        return $this;
    }

    public function getVilleVis(): ?string
    {
        return $this->Ville_vis;
    }

    public function setVilleVis(string $Ville_vis): self
    {
        $this->Ville_vis = $Ville_vis;

        return $this;
    }

    public function getDateEmbaucheVis(): ?\DateTimeInterface
    {
        return $this->dateEmbauche_vis;
    }

    public function setDateEmbaucheVis(\DateTimeInterface $dateEmbauche_vis): self
    {
        $this->dateEmbauche_vis = $dateEmbauche_vis;

        return $this;
    }

    public function getLedepartement(): ?Departement
    {
        return $this->ledepartement;
    }

    public function setLedepartement(?Departement $ledepartement): self
    {
        $this->ledepartement = $ledepartement;

        return $this;
    }

    public function getLesecteur(): ?Secteur
    {
        return $this->lesecteur;
    }

    public function setLesecteur(?Secteur $lesecteur): self
    {
        $this->lesecteur = $lesecteur;

        return $this;
    }
}
