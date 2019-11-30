<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DepartementRepository")
 */
class Departement
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
    private $code_Dep;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom_Dep;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $chefvente_dep;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Visiteur", mappedBy="ledepartement")
     */
    private $visiteurs;

    public function __construct()
    {
        $this->visiteurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeDep(): ?string
    {
        return $this->code_Dep;
    }

    public function setCodeDep(string $code_Dep): self
    {
        $this->code_Dep = $code_Dep;

        return $this;
    }

    public function getNomDep(): ?string
    {
        return $this->nom_Dep;
    }

    public function setNomDep(string $nom_Dep): self
    {
        $this->nom_Dep = $nom_Dep;

        return $this;
    }

    public function getChefventeDep(): ?string
    {
        return $this->chefvente_dep;
    }

    public function setChefventeDep(string $chefvente_dep): self
    {
        $this->chefvente_dep = $chefvente_dep;

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
            $visiteur->setLedepartement($this);
        }

        return $this;
    }

    public function removeVisiteur(Visiteur $visiteur): self
    {
        if ($this->visiteurs->contains($visiteur)) {
            $this->visiteurs->removeElement($visiteur);
            // set the owning side to null (unless already changed)
            if ($visiteur->getLedepartement() === $this) {
                $visiteur->setLedepartement(null);
            }
        }

        return $this;
    }
}
