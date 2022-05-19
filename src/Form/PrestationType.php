<?php

namespace App\Form;

use App\Entity\Prestation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
            ->add('titre', TextType::class, [
                'label' => 'Titre Préstation',
                'required' => true
            ])
            ->add('texte', TextareaType::class, [
                'label' => 'Texte Présation'
            ])

            ->add('image', FileType::class , [
                'label' => 'Image Expérience',
                'mapped'=>false,
                'required' => false,
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
