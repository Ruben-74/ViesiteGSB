<?php

namespace App\Form;

use App\Entity\Visiteur;
use App\Form\ApplicationType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class VisiteurType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('matricule', TextType::class, $this->getConfiguration("Code", "Tapez un matricule"))
            ->add('Nom_vis', TextType::class, $this->getConfiguration("Nom", "Renseignez votre nom "))
            ->add('adresse_vis', TextType::class, $this->getConfiguration("Adresse", "Inserez votre adresse"))
            ->add('CP_vis',  TextType::class, $this->getConfiguration("code Postale", "Inserez votre Code Postale "))
            ->add('Ville_vis', TextType::class, $this->getConfiguration("Ville", "Renseignez votre Ville "))
            ->add('dateEmbauche_vis',DateType::class, $this->getConfiguration("Date", "Renseignez votre date d'embauche"))

             ->add('ledepartement', EntityType::class, array(
                     'class'        => 'App\Entity\Departement',
                     'choice_label' => 'nomDep',
                     'multiple'     => false,
             ))
             ->add('lesecteur', EntityType::class, array(
                'class'        => 'App\Entity\Secteur',
                'choice_label' => 'libelleSec',
                'multiple'     => false,
        ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Visiteur::class,
        ]);
    }
}
