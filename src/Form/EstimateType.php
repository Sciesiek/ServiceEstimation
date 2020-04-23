<?php

namespace App\Form;

use App\Entity\Estimate;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Client;
use App\Entity\Adres;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class EstimateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['label' => 'Nazwa',])
            ->add('description', TextType::class, ['label' => 'Opis',])
            ->add('adres', EntityType::class, [
                'label' => 'Adres',
                // looks for choices from this entity
                'class' => Adres::class,
                'placeholder' => 'Proszę wybrać',
                'empty_data'  => null,
                'required' => false,
            ])
            ->add('client', EntityType::class, [
                'label' => 'Klient',
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
