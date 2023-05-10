<?php

namespace App\Form;

use App\Entity\Annonces;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ValidatedAnnonceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('job')
            ->add('salairy')
            ->add('annonce')
            ->add('locality')
            ->add('schedules')
            ->add('isApproved',ChoiceType::class, [
                'choices' => [
                    'Oui' => true,
                    'Non' => false,
                   
                ],
                'label'=>'Validé le compte',
                'expanded' => true,
                'multiple' => false,
            ])
            ->add('recruteur')
            ->add('user')
            ->add('Envoyer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Annonces::class,
        ]);
    }
}
