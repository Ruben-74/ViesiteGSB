<?php

namespace App\Entity;

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
}
