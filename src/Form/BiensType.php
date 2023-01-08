<?php

namespace App\Form;

use App\Entity\Admin;
use App\Entity\Biens;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BiensType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type_bien')
            ->add('titre_bien')
            ->add('surface_bien')
            ->add('prix_bien')
            ->add('localisation_bien')
            ->add('description_bien', TextareaType::class, ['required' => false])
            ->add('image')
            ->add('categorie',EntityType::class, [
                'class' =>Categorie::class,
                'choice_label' => 'titre_cat',
                'multiple' => false,
                'expanded' => false,
                'required' => true
            ])
            ->add('adm_id', EntityType::class, [
                'class' => Admin::class,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Biens::class,
        ]);
    }
}
