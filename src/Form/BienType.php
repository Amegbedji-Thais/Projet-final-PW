<?php

namespace App\Form;

use App\Entity\Bien;
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
            ->add('id_Cat')
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
