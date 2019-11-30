<?php

namespace App\Form;

use App\Entity\Secteur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class SecteurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('libelle_sec', TextType::class, [
            'attr' => [
                'placeholder' => "Nom du Secteur"
            ]
        ]);
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Secteur::class,
        ]);
    }
}
