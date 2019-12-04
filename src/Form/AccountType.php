<?php

namespace App\Form;

use App\Entity\Visiteur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AccountType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('matricule')
            ->add('Nom_vis')
            ->add('adresse_vis')
            ->add('CP_vis')
            ->add('Ville_vis')
            ->add('dateEmbauche_vis')
            ->add('coverImage')
            ->add('hash')
            ->add('ledepartement')
            ->add('lesecteur')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Visiteur::class,
        ]);
    }
}
