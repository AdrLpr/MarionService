<?php

namespace App\Form;

use App\Entity\Tarif;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TarifType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        
        ->add('prix', MoneyType::class, [
            'label' => 'Prix',
            'required' => true
        ])->add('duree', TextType::class, [
            'label' => 'Durée',
            'required' => true
        ])
        ->add('tarifTemps', TextareaType::class, [
            'label' => 'Texte Tarif'
        ])
        ->add('choix', ChoiceType::class, [
            'label' => 'Choix du type',
            'required' => true,
            'choices' => [
                '---' => null,
                '2h'=> true,
                'Pour le mois'=>false,
            ]
        ])
        ->add('submit', SubmitType::class, [
            'label'=> 'Envoyer',
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tarif::class,
        ]);
    }
}
