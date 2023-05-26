<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            
           
            ->add('old_password', PasswordType::class,[
                'mapped'=>false,
                'label'=> "Mon mot de passe actuel"
            ])

            ->add('new_password', RepeatedType::class, [
                'type' => PasswordType::class,
                'mapped'=>false,
                'invalid_message' => 'Le mot de passe et la confirmation doivent être identique.',
                'label' => 'Mon nouveau mot de passe',
                'required' => true,
                'first_options' => [
                    'label' => 'Mon nouveau mot de passe',
                    'attr' => [
                        'placeholder' => 'Merci de saisir votre nouveau mot de passe.',
                       
                    ],
                    'constraints' => [
                        new Length([
                            'min'=> 8,
                            'minMessage' => 'Le mot de passe doit comporter au moins 8 caractères.',
                        ]),
                    ],
                ],
                'second_options' => [
                    'label' => 'Confirmez votre nouveau mot de passe',
                    'attr' => [
                        'placeholder' => 'Merci de confirmer votre nouveau mot de passe.'
                    ]
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => "Enregistré"
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
