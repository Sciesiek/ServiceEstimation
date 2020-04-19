<?php

namespace App\Form;

use App\Entity\Adres;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Entity\Client;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class AdresType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('city')
            ->add('street')
            ->add('housingNumber')
            ->add('postal')
            ->add('client', EntityType::class, [
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
