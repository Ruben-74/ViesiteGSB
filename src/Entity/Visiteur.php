<?php

namespace App\Entity;

use App\Entity\Role;
use Cocur\Slugify\Slugify;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VisiteurRepository")
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity(
 * fields={"email"},
 * message= "Un autre utilisateur s'est deja inscrit avec ce mail, merci de la modifier"
 * )
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
     * @Assert\NotBlank(message="Veuillez renseigner votre matricule!")
     */
    private $matricule;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="Veuillez renseigner votre prenom!")
     */
    private $Nom_vis;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Veuillez renseigner votre adresse!")
     */
    private $adresse_vis;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Veuillez renseigner votre code Postale!")
     */
    private $CP_vis;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="Veuillez renseigner votre ville!")
     */
    private $Ville_vis;

    /**
     * @ORM\Column(type="date" , nullable=true)
     * @Assert\NotBlank(message="Veuillez renseigner votre date d'embauche!")
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $hash;

    //pas d'anotation il existe pas dans la bdd

    /**
     * 
     */
    public $passwordConfirm;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Role", mappedBy="roles")
     */
    private $visiteur_roles;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Travailler", mappedBy="lesVisiteurs")
     */
    private $travaillers;


    public function __construct()
    {
        $this->visiteur_roles = new ArrayCollection();
        $this->travaillers = new ArrayCollection();
    }


    public function getFullName(){
        return "{$this->Nom_vis} ";
    }
    /**
     * Permet d'initialiser le slug
     *
     * @ORM\PrePersist
     * @ORM\PreUpdate
     * 
     * @return void
     */
    public function initializeSlug(){
        if (empty($this->Nom_vis)) {
            
            $slugify = new Slugify();
            $this->Nom_vis = $slugify->Slugify($this->Nom_vis);
                
        }
    }

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

        $roles = $this->visiteur_roles->map(function($role){
            return $role->getTitle();
        })->ToArray();

        $roles[]= 'ROLE_USER';
        
        return $roles;
    }


    public function getPassword(){
        return $this->hash;
    }

    public function getSalt(){

    }

    public function getUsername(){
        return $this->email;
    }

    public function eraseCredentials(){

    }

    /**
     * @return Collection|Role[]
     */
    public function getVisiteurRoles(): Collection
    {
        return $this->visiteur_roles;
    }

    public function addVisiteurRole(Role $visiteurRole): self
    {
        if (!$this->visiteur_roles->contains($visiteurRole)) {
            $this->visiteur_roles[] = $visiteurRole;
            $visiteurRole->addRole($this);
        }

        return $this;
    }

    public function removeVisiteurRole(Role $visiteurRole): self
    {
        if ($this->visiteur_roles->contains($visiteurRole)) {
            $this->visiteur_roles->removeElement($visiteurRole);
            $visiteurRole->removeRole($this);
        }

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

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
            $travailler->setLesVisiteurs($this);
        }

        return $this;
    }

    public function removeTravailler(Travailler $travailler): self
    {
        if ($this->travaillers->contains($travailler)) {
            $this->travaillers->removeElement($travailler);
            // set the owning side to null (unless already changed)
            if ($travailler->getLesVisiteurs() === $this) {
                $travailler->setLesVisiteurs(null);
            }
        }

        return $this;
    }

}
