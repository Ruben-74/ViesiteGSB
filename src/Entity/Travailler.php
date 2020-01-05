<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TravaillerRepository")
 */
class Travailler
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $poste;

    /**
     * @ORM\Column(type="date")
     */
    private $date_inscription;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Region", inversedBy="travaillers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $lesRegions;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPoste(): ?string
    {
        return $this->poste;
    }

    public function setPoste(?string $poste): self
    {
        $this->poste = $poste;

        return $this;
    }

    public function getDateInscription(): ?\DateTimeInterface
    {
        return $this->date_inscription;
    }

    public function setDateInscription(\DateTimeInterface $date_inscription): self
    {
        $this->date_inscription = $date_inscription;

        return $this;
    }

    public function getLesRegions(): ?Region
    {
        return $this->lesRegions;
    }

    public function setLesRegions(?Region $lesRegions): self
    {
        $this->lesRegions = $lesRegions;

        return $this;
    }

}
