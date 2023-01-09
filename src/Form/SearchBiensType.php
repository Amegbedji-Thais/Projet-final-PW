<?php

namespace App\Form;

use App\Entity\Biens;
use App\Entity\Categories;
use App\Faker\BiensProvider;
use Bezhanov\Faker\ProviderCollectionHelper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchBiensType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type_bien', ChoiceType::class, [
                'choices' => array_combine(BiensProvider::TYPE, BiensProvider::TYPE)
            ])
            /*->add('titre_bien')
            ->add('surface_bien')
            ->add('prix_bien')
            ->add('localisation_bien')*/
            ->add('Categorie',EntityType::class, [
                'class' =>Categories::class,
                'choice_label' => 'titre_cat',
                'multiple' => false,
                'expanded' => false,
                'required' => true
            ])
            ->add('Chercher', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Biens::class,
        ]);
    }
}
