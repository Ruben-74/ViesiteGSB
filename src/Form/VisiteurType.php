<?php

namespace App\Form;

use App\Entity\Visiteur;
use App\Form\SecteurType;
use App\Form\ApplicationType;
use App\Form\DepartementType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

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
            ->add('dateEmbauche_vis',DateType::class, $this->getConfiguration("Date", "Renseignez votre date d'embauche"));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Visiteur::class,
        ]);
    }
}
