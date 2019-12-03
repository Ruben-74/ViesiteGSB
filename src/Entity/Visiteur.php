<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VisiteurRepository")
 */
class Visiteur implements UserInterface
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Departement", inversedBy="visiteurs" , cascade={"persist"})
     */
    private $ledepartement;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Secteur", inversedBy="visiteurs" , cascade={"persist"})
     */
    private $lesecteur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $coverImage;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $hash;

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

    public function getCoverImage(): ?string
    {
        return $this->coverImage;
    }

    public function setCoverImage(string $coverImage): self
    {
        $this->coverImage = $coverImage;

        return $this;
    }

    public function getHash(): ?string
    {
        return $this->hash;
    }

    public function setHash(string $hash): self
    {
        $this->hash = $hash;

        return $this;
    }

    //tien compte des roles Admin des USER
    public function getRoles(){

        $roles = $this->userRoles->map(function($role){
            return $role->getTitle();
        })->ToArray();

        $roles[]= 'ROLE_USER';
        
        return $roles;
    }

    public function getPassword(){
        return$this->hash;
    }

    public function getSalt(){

    }

    public function getUsername(){
        return $this->email;
    }

    public function eraseCredentials(){

    }
}
