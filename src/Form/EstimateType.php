<?php

namespace App\Form;

use App\Entity\Estimate;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Client;
use App\Entity\Adres;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class EstimateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('adres', EntityType::class, [
                // looks for choices from this entity
                'class' => Adres::class,
                'placeholder' => 'Proszę wybrać',
                'empty_data'  => null,
                'required' => false,
            ])
            ->add('client', EntityType::class, [
                // looks for choices from this entity
                'class' => Client::class,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Estimate::class,
        ]);
    }
}
