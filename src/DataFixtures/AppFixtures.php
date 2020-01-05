<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Role;
use App\Entity\Region;
use App\Entity\Secteur;
use App\Entity\Visiteur;
use App\Entity\Travailler;
use App\Entity\Departement;
use App\Repository\SecteurRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $visiteurs;

    private $departements;

    private $regions;

    private $secteurs;

    private $postes;

    private $encoder;


    public function __construct(UserPasswordEncoderInterface $encoder){
       
        $this->encoder = $encoder;
    }
    

    public function load(ObjectManager $manager)
    {
        $this->importDepartements($manager);
        $this->creationSecteur($manager);
        $this->importRegion($manager);
        $this->CreationVisiteurs($manager);
        $this->Travail_Poste($manager);
    }

    public function CreationVisiteurs($manager)
    {
        //creation des fixtures de visiteurs

        $faker = Factory::create('FR-fr');
        
        $chaine = ('abcdefghijklmnopkrstuvwxyz0123456789');
        
        
        $genres = ['male' , 'female'];


        $adminRole = new Role();
        $adminRole->setTitle('ROLE_ADMIN');
        $manager->persist($adminRole);

        //creation d'un visiteur admin

            $visiteur = new Visiteur();

            $ref = str_shuffle(substr($chaine, rand(0, 36), rand(0, 36)));

            $hash = $this->encoder->encodePassword($visiteur, 'password');

            $visiteurs =[];
            
            $genre = $faker->randomElement($genres);

            $picture= 'https://randomuser.me/api/portraits/';

            $pictureId = $faker->numberBetween(1,99) .'.jpg' ;

            $picture .= ($genre == 'male' ? 'men/' : 'women/') .$pictureId;

            $visiteur->setMatricule('1')
                ->setNomVis('Ruben')
                ->setAdresseVis('Avenue Jean Paul')
                ->setCPVis('78680')
                ->setVilleVis('Epone')
                ->setEmail('ruben@gmail.com')
                ->setDateEmbaucheVis($faker->datetime)
                ->setCoverImage($picture)
                ->setHash($this->encoder->encodePassword($visiteur, 'password'))
                ->setLedepartement($this->departements[2])
                ->setLesecteur($this->secteurs[5])
                ->AddVisiteurRole($adminRole);
                
                $manager->persist($visiteur);

        //generer des visiteurs lambda

        for ($i=1 ; $i <= 30 ; $i++) { 

            $visiteur = new Visiteur();

            $ref = str_shuffle(substr($chaine, rand(0, 36), rand(0, 36)));

            $hash = $this->encoder->encodePassword($visiteur, 'password');

            
            $genre = $faker->randomElement($genres);

            $picture= 'https://randomuser.me/api/portraits/';

            $pictureId = $faker->numberBetween(1,99) .'.jpg' ;

            $picture .= ($genre == 'male' ? 'men/' : 'women/') .$pictureId;

            $visiteur->setMatricule($ref)
                ->setNomVis($faker->lastname)
                ->setAdresseVis($faker->address)
                ->setCPVis($faker->postcode)
                ->setVilleVis($faker->city)
                ->setEmail($faker->email)
                ->setDateEmbaucheVis($faker->datetime)
                ->setCoverImage($picture)
                ->setHash($hash)
                ->setLedepartement($this->departements[mt_rand(0,100)])
                ->setLesecteur($this->secteurs[mt_rand(0,5)]);
    
                $manager->persist($visiteur);

                $visiteurs[] = $visiteur;
            }
            
            $manager->flush();
            
        
    }

    //importation des departements
    public function importDepartements($manager)
    {
        $faker = Factory::create('FR-fr');
        
        $fic = fopen("public/departement.csv", "r");
        while($tab=fgetcsv($fic,','))
        {
            $departement = new Departement();
            $departement->setCodeDep($tab[1])
                        ->setNomDep($tab[2])
                        ->setChefventeDep($faker->lastname);
            $this->departements[]= $departement;

            $manager->persist($departement);
        }
        $manager->flush();
    }

    //remplir la table secteur
    public function creationSecteur($manager)
    {
            $lesSecteurs = array(
            "1"=>"Paris-Ouest",
            "2"=>"Nord",
            "3"=> "Ouest", 
            "4"=>"Sud", 
            "5"=>"Est", 
            "6"=>"DTOM"); 
    
        foreach ($lesSecteurs as $cle => $valeur ) { 

            $secteur = new Secteur();
            
            $secteur->setCodeSec($cle)
                    ->setLibelleSec($valeur);
                    
            $manager->persist($secteur);
            $this->secteurs[]= $secteur;
            $manager->flush();
            
        }    
        
    }
        
    //importation des regions
    public function importRegion($manager)
    {

        $fic = fopen("public/regions.csv", "r");
        while($tabl=fgetcsv($fic,','))
        {
            $region = new Region();
            $secteur = new Secteur();

            $region->setCodeReg($tabl[0])
                   ->setNomReg($tabl[1])
                   ->setLeSecteur($this->secteurs[mt_rand(0,5)]);

            $this->regions[]= $region;
            
            $manager->persist($region);

        }
        $manager->flush();

    }

    public function Travail_Poste($manager){

        $lespostes= array(
            "Medecin generaliste",
            "Pharmacien",
            "Infirmier",
            "Specialiste"
        );

        $faker = Factory::create('FR-fr');
        
        for($i=1 ; $i <= 30 ; $i++) { 

            $travail = new Travailler();
            
            $travail->setPoste($lespostes[mt_rand(0,3)])
                    ->setDateInscription($faker->datetime)
                    ->setLesRegions($this->regions[mt_rand(1,17)]);
                    
            $manager->persist($travail);
            $manager->flush();
        }
        
        $this->postes[]= $travail;

    }
    
}
