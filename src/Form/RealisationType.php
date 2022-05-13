<?php

namespace App\Form;

use App\Entity\Realisation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class RealisationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
                'label' => 'Titre Réalisation',
                'required' => true
            ])
            ->add('image', FileType::class , [
                'label' => 'Image Réalisation',
                'mapped'=>false,
                'required' => false,
                'constraints' => [
                    new File ([
                        'maxSize'=> '1024k',
                        'mimeTypesMessage'=>'Mauvais type',
                    ])
                ],
            ])
            ->add('lien', TextType::class, [
                'label' => 'lien Réalisation',
                'required' => true
            ])
            ->add('submit',SubmitType::class, [
                'label' => 'Envoyer'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Realisation::class,
        ]);
    }
}
