<?php

namespace App\Form;

use App\Entity\Annonces;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnnonceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('job',TextType::class,[
                'label'=>'Quel emploi rechercher vous',
                'attr'=>[
                    'placeholder'=>'serveur'
                ]
            ])
            ->add('salairy',TextType::class,[
                'label'=>'le montant du salaire brut',
                'attr'=>[
                    'placeholder'=>'1684 €'
                ]
            ])
            ->add('annonce',TextType::class,[
                'label'=>'Rédiger votre annonce',
                'attr'=>[
                    'placeholder'=>'Rédiger votre annonce'
                ]
            ])
            ->add('recruteur')
            ->add('submit', SubmitType::class,[
                'label'=>'poster mon annonce'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Annonces::class,
        ]);
    }
}
