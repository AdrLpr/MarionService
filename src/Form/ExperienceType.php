<?php

namespace App\Form;

use App\Entity\Experience;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class ExperienceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
                'label' => 'Titre Expérience',
                'required' => true
            ])
            ->add('texte', TextareaType::class, [
                'label' => 'Texte Expérience'
            ])
            ->add('image', TextType::class , [ //FileType et cherche comment Upload un fichier
                'label' => 'Image Expérience',
                'required' => true
                // 'constraints' => [
                //     new File([ 
                //         'maxSize' => '1024k',
                //         // 'mimeTypes' => [
                //         //     'application/png',
                //         //     'application/x-pdf',
                //         // ],
                //         'mimeTypesMessage' => 'Please upload a valid document',
                //     ])
                // ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Envoyer'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Experience::class,
        ]);
    }
}
