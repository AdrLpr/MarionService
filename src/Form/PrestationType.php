<?php

namespace App\Form;

use App\Entity\Prestation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PrestationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
                'label' => 'Titre Préstation',
                'required' => true
            ])
            ->add('texte', CollectionType::class, [
                'label' => 'Texte Préstation',
                'entry_type'=>TextareaType::class,
                    'entry_options' =>
                    [ 'attr' => ['class' => "email_box"],
                ],
                'allow_add'=> true,
                'prototype'=> true
            ])
            ->add('choix', ChoiceType::class, [
                'label' => 'Choix de la page',
                'required' => true,
                'choices' => [
                    '---' => null,
                    'Secretariat'=> true,
                    'Site web'=>false,
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
            'data_class' => Prestation::class,
        ]);
    }
}
