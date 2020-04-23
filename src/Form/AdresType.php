<?php

namespace App\Form;

use App\Entity\Adres;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\Entity\Client;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Length;

class AdresType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('city', TextType::class, ['label' => 'Miasto','trim' => false,'required' => true,])
            ->add('street', TextType::class, ['label' => 'Ulica','trim' => false,'required' => true,])
            ->add('housingNumber', TextType::class, ['label' => 'Numer domu/ulicy','trim' => false,])
            ->add('postal', TextType::class, ['label' => 'Kod Pocztowy','trim' => false,/*
            'constraints' => [new Length([
                'min' => 7,
                'max' => 7,
            ])],*/'required' => true,])
            ->add('client', EntityType::class, [
                'label' => 'Klient',
                // looks for choices from this entity
                'class' => Client::class,
                //'choice_label' => 'surname', 
                //if not set label default gets __toString() from Entity
                'placeholder' => 'Proszę wybrać',
                'empty_data'  => null,
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Adres::class,
        ]);
    }
}
