<?php

namespace App\Form\Security;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label'=>'email',
                'required'=>true
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Nom:',
                'required' => true,
            ])
            ->add('firstName', TextType::class , [
                'label' => 'Prénom :',
                'required'=> false
            ])
            ->add('roles', ChoiceType::class, [
                'label'=>'role :',
                'required'=> true,
                'choices'=> [
                    'Utilisateur'=> 'ROLE_USER',
                    'Administrateur'=>'ROLE_ADMIN',
                ],
            ])
            ->add('password', RepeatedType::class, [
                'type'=>PasswordType::class,
                'required'=>true,
                'first_options'=>[
                    'label'=> 'Votre mot de passe',
                ],
                'second_options'=> [
                    'label'=> 'Répétez le mot de passe'
                ]
            ])
            ->add('tel', TelType::class, [
                'label' => 'Téléphone :',
                'required'=>false
            ])
            ->add('submit', SubmitType::class, [
                'label'=> 'Envoyer'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
