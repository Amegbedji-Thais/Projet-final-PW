<?php

namespace App\Form;

use App\Entity\Bien;
use App\Entity\Categorie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BienType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Type_Bien')
            ->add('Titre_Bien')
            ->add('Surface_Bien')
            ->add('Prix_Bien')
            ->add('Localisation_Bien')
            ->add('Description_Bien')
            ->add('id_Cat', EntityType::class, [
                'class' =>Categorie::class,
                'choice_label' => 'titre_cat',
                'multiple' => false,
                'expanded' => false,
                'required' => true
            ])
            ->add('id_Fav')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Bien::class,
        ]);
    }
}
