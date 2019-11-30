<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SecteurRepository")
 */
class Secteur
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
    private $code_sec;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libelle_sec;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Region", mappedBy="lesecteur")
     */
    private $regions;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Visiteur", mappedBy="lesecteur")
     */
    private $visiteurs;

    public function __construct()
    {
        $this->regions = new ArrayCollection();
        $this->visiteurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeSec(): ?string
    {
        return $this->code_sec;
    }

    public function setCodeSec(string $code_sec): self
    {
        $this->code_sec = $code_sec;

        return $this;
    }

    public function getLibelleSec(): ?string
    {
        return $this->libelle_sec;
    }

    public function setLibelleSec(string $libelle_sec): self
    {
        $this->libelle_sec = $libelle_sec;

        return $this;
    }

    /**
     * @return Collection|Region[]
     */
    public function getRegions(): Collection
    {
        return $this->regions;
    }

    public function addRegion(Region $region): self
    {
        if (!$this->regions->contains($region)) {
            $this->regions[] = $region;
            $region->setLesecteur($this);
        }

        return $this;
    }

    public function removeRegion(Region $region): self
    {
        if ($this->regions->contains($region)) {
            $this->regions->removeElement($region);
            // set the owning side to null (unless already changed)
            if ($region->getLesecteur() === $this) {
                $region->setLesecteur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Visiteur[]
     */
    public function getVisiteurs(): Collection
    {
        return $this->visiteurs;
    }

    public function addVisiteur(Visiteur $visiteur): self
    {
        if (!$this->visiteurs->contains($visiteur)) {
            $this->visiteurs[] = $visiteur;
            $visiteur->setLesecteur($this);
        }

        return $this;
    }

    public function removeVisiteur(Visiteur $visiteur): self
    {
        if ($this->visiteurs->contains($visiteur)) {
            $this->visiteurs->removeElement($visiteur);
            // set the owning side to null (unless already changed)
            if ($visiteur->getLesecteur() === $this) {
                $visiteur->setLesecteur(null);
            }
        }

        return $this;
    }

}
