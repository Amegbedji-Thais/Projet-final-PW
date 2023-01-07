<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('q', TextType::class, [
                'label'=> false,
                'required'=>false,
                'attr'=> [
                    'placeholder' => 'Rechercher un bien'
                ]
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data-class'=>searchData::class,
            'method'=>'GET',
            'crsf_protection' => false
        ]);
    }

    public function getBlockPrefix()
    {
       return '';
    }
}