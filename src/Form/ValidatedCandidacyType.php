<?php

namespace App\Form;

use App\Entity\Candidacy;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ValidatedCandidacyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('isApproved',ChoiceType::class, [
                'choices' => [
                    'Oui' => true,
                    'Non' => false,
                   
                ],
                'label'=>'Validé le compte',
                'expanded' => true,
                'multiple' => false,
            ])
            ->add('annonce')
            ->add('user')
            ->add('Valide', SubmitType::class,[
                'label'=>'Validé'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Candidacy::class,
        ]);
    }
}
