<?php

namespace App\Form;

use App\Entity\Visiteur;
use App\Form\ApplicationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class RegistrationType extends ApplicationType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Matricule',TextType::class, $this->getConfiguration("Matricule", "Definissez votre matricule ..."))
            ->add('Nom_vis',TextType::class, $this->getConfiguration("Prenom", "Votre prenom ..."))
            ->add('adresse_vis', TextType::class, $this->getConfiguration("Adresse", "Votre adresse ..."))
            ->add('CP_vis',TextType::class, $this->getConfiguration("Code Postale", "Votre code postale ..."))
            ->add('Ville_vis',TextType::class, $this->getConfiguration("Ville", "Votre ville ..."))
            ->add('coverImage',TextType::class, $this->getConfiguration("Photo de Profil", "Votre image ..."))
            ->add('ledepartement', EntityType::class, array(
                'class'        => 'App\Entity\Departement',
                'choice_label' => 'nomDep',
                'multiple'     => false,
                ))
            ->add('lesecteur', EntityType::class, array(
                    'class'        => 'App\Entity\Secteur',
                    'choice_label' => 'libelleSec',
                    'multiple'     => false,
                ))
            ->add('dateEmbauche_vis',DateType::class, $this->getConfiguration("Date d'embauche", "Renseigner votre date ..."))
            //confirmation mdp
            ->add('hash',PasswordType::class, $this->getConfiguration("Mot de passe", "Choisissez un bon mot de passe !"))
            ->add('passwordConfirm', PasswordType::class,$this->getConfiguration("Confirmation de mot de passe", "Veuillez confirmer votre mot de passe"))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Visiteur::class,
        ]);
    }
}
