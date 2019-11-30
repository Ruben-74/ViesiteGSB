<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Region;
use App\Entity\Secteur;
use App\Entity\Visiteur;
use App\Entity\Departement;
use App\Repository\SecteurRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{


    private $departements;

    private $regions;

    private $secteurs;

    public function load(ObjectManager $manager)
    {
        
        
        $this->importDepartements($manager);
        $this->creationSecteur($manager);
        $this->importRegion($manager);
        $this->CreationVisiteurs($manager);
        
    }

    public function CreationVisiteurs($manager)
    {
        //creation des fixtures de visiteurs

        $faker = Factory::create('FR-fr');

        $chaine = ('abcdefghijklmnopkrstuvwxyz0123456789');

        for ($i=1 ; $i <= 30 ; $i++) { 

            $visiteur = new Visiteur();

            $ref = str_shuffle(substr($chaine, rand(0, 36), rand(0, 36)));


            $visiteur->setMatricule($ref)
                ->setNomVis($faker->lastname)
                ->setAdresseVis($faker->address)
                ->setCPVis($faker->postcode)
                ->setVilleVis($faker->city)
                ->setDateEmbaucheVis($faker->datetime)
                ->setLedepartement($this->departements[mt_rand(0,100)])
                ->setLesecteur($this->secteurs[mt_rand(0,5)]);

                $manager->persist($visiteur);
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
            $manager->flush();
            $this->secteurs[]= $secteur;
            
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
    
}
