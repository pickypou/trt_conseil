<?php

namespace App\Form;

use App\Entity\Annonces;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnnonceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('job',ChoiceType::class,[
                'choices' => [
                   
                        'Serveur(se)' => 'Serveur(se)',
                        'Chef de rang 2' => 'Chef de rang',
                        'Commis de cuisine' => 'Commis de cuisine',
                        'Chef de cuisine' => 'Chef de cuisine',
                        'Cuisinier(ère)' => 'Cuisinier(ère)',
                        'Pâtissier(ère)' => 'Pâtissier(ère)',
                        'Boulanger(ère)' => 'Boulanger(ère) ',
                        'Plongeur(euse)' => 'Plongeur(euse)',
                        'Maître d\'hôtel' => 'Maître d\'hôtel',
                        'Sommelier(ère)' => 'Sommelier(ère)',
                        'Barman / Barmaid' => 'Barman / Barmaid',
                        'Responsable de salle' => 'Responsable de salle',
                        'Hôte(sse) d\'accueil' => 'Hôte(sse) d\'accueil',
                        'Responsable de cuisine' => 'Responsable de cuisine',
                        'Second de cuisine' => 'Second de cuisine',
                        // Ajouter autant d'options que nécessaire
                    ],
                    'label' => 'Emploi recherché',
                    'required' => true,
                ])
                    
                
               
         
            ->add('salairy',TextType::class,[
                'label'=>'le montant du salaire brut',
                'attr'=>[
                    'placeholder'=>'1684 €'
                ]
            ])
            ->add('locality',TextType::class,[
                'label'=>"La ville ou ce situe votre restaurant",
                'attr'=>[
                    'placeholder'=>'Toulouse'
                ]
            ])
            ->add('schedules',TextType::class,[
                'label'=>'Horaires de travail',
                'attr'=>[
                    'placeholder'=>'de 11H00 à 18H00 du lundi au samedi'
                ]
            ])
            ->add('annonce',TextareaType::class,[
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
