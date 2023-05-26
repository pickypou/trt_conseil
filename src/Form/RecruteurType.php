<?php

namespace App\Form;

use App\Entity\Recruteur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecruteurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('companyname',TextType::class,[
                'label'=>"Le nom de l'entrprise",
                'attr'=>[
                    'placeholder'=>'le grand restaurent'
                ]
            ])
            ->add('address',TextType::class,[
                'label'=>'numéro, rue,  ville, code Postal',
                'attr'=>[
                    'placeholder'=>'15 Rue JeanDupont lille 59000'
                ]
            ])
            ->add('phone',TextType::class,[
                'label'=>'Votre numéro de téléphone',
                'attr'=>[
                    'placeholder'=>'0132458549'
                ]
            ])
            ->add('siteweb',TextType::class,[
                'label'=>'Adresse du site web',
                'attr'=>[
                    'placeholder'=>'https://www.monSiteWeb.com'
                ]
            ])
            ->add('description',TextareaType::class,[
                'label'=>'Description de vos spécialitées'
            ])
            ->add('user')

            ->add('submit',SubmitType::class,[
                'label'=>'soumétre'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recruteur::class,
        ]);
    }
}
