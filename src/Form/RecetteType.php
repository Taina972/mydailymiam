<?php

namespace App\Form;

use App\Entity\Recette;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class RecetteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class,[
                'label' => 'Nom de la recette'
            ])

            ->add('date', DateTimeType::class,[
                'label' => 'Date de publication'
            ])
           
           
            ->add('preparation', TextareaType::class,[
                'label' => 'Etapes de la préparation'
            ])
            ->add('time', TextType::class,[
                'label' => "Temps de cuisson"
            ])
            ->add('ingredient', TextType::class,[
                'label' => "Ingrédients"
            ])
            ->add('image', FileType::class,[
                'label' => "Plat"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Recette::class,
        ]);
    }
}
