<?php

namespace App\Form;

use App\Entity\Prestation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class PrestationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('texte', CollectionType::class, [ //crée un tableau et autorise de crée de nouvelles ligne de texte
                'label' => 'Texte Présation',
                'entry_type'=>TextType::class,
                'entry_options' => [
                    'attr'=> ['class' => 'texte_box'],
                ],
                'allow_add' => true,
                'prototype' => true,
                'prototype_data' => '0',
                'prototype_name' => '0',
                'required' => false,
                'mapped'=> true
            ])

            ->add('image', FileType::class , [ // ajoute les images
                'label' => 'Image Expérience',
                'mapped'=>false,
                'required' => false,// pour ne pas avoir les remette si update
                'constraints' => [
                    new File ([
                        'maxSize'=> '1024k',
                        'mimeTypesMessage'=>'Mauvais type',
                    ])
                ],
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
