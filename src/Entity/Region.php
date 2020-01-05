<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RegionRepository")
 */
class Region
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
    private $codeReg;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $NomReg;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Secteur", inversedBy="regions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $lesecteur;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Travailler", mappedBy="lesRegions")
     */
    private $travaillers;


    public function __construct()
    {
        $this->travaillers = new ArrayCollection();
        $this->cls = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeReg(): ?string
    {
        return $this->codeReg;
    }

    public function setCodeReg(string $codeReg): self
    {
        $this->codeReg = $codeReg;

        return $this;
    }

    public function getNomReg(): ?string
    {
        return $this->NomReg;
    }

    public function setNomReg(string $NomReg): self
    {
        $this->NomReg = $NomReg;

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

    /**
     * @return Collection|Travailler[]
     */
    public function getTravaillers(): Collection
    {
        return $this->travaillers;
    }

    public function addTravailler(Travailler $travailler): self
    {
        if (!$this->travaillers->contains($travailler)) {
            $this->travaillers[] = $travailler;
            $travailler->setLesRegions($this);
        }

        return $this;
    }

    public function removeTravailler(Travailler $travailler): self
    {
        if ($this->travaillers->contains($travailler)) {
            $this->travaillers->removeElement($travailler);
            // set the owning side to null (unless already changed)
            if ($travailler->getLesRegions() === $this) {
                $travailler->setLesRegions(null);
            }
        }

        return $this;
    }

}
