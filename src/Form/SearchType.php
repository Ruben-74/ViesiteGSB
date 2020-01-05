<?php

namespace App\Form;

use App\Entity\Search;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('ledepartement', EntityType::class, array(
            'class'        => 'App\Entity\Departement',
            'choice_label' => 'nomDep',
        ))

        ->add('lesecteur', EntityType::class, array(
            'class'        => 'App\Entity\Secteur',
            'choice_label' => 'libelleSec',
         ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([

        ]);
    }
}
