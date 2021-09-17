<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\DomCrawler\Image;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('email',EmailType::class,[
                'label'=>'Email',
                'attr' =>[
                    'placeholder' =>'Entrez votre email'
                ]
            ]) 

             ->add('lastname', TextType::class,[
                 'label' => 'Nom de famille',
                 'attr' =>[
                     'placeholder' =>'Entrez votre nom de famille'
                 ]
             ]) 
             
             ->add('firstname', TextType::class,[
                'label' => 'Prénom',
                'attr' =>[
                    'placeholder' =>'Entrez votre prénom'
                ]
            ])  

            ->add('birthday', BirthdayType::class,[
                'label' => 'Date de naissance',
                'attr' =>[
                    'placeholder' =>'Entrez votre date de naissance'
                ]
            ])  

            ->add('city', TextType::class,[
                'label' => 'Ville',
                'attr' =>[
                    'placeholder' =>'Indiquez votre ville'
                ]
            ])  

            ->add('zipcode', TextType::class,[
                'label' => 'Code postal',
                'attr' =>[
                    'placeholder' =>'Indiquez votre code postal'
                ]
            ])  

            ->add('country', TextType::class,[
                'label' => 'Pays',
                'attr' =>[
                    'placeholder' =>'Indiquez votre pays'
                ]
            ])  

            ->add('pp', TextType::class,[
                'label' => 'Avatar',
                'attr' =>[
                    'placeholder' =>'Choisissez votre avatar'
                ]
            ])  

            ->add('agreeTerms', CheckboxType::class, [
                'label' => 'Accepter les conditions d\'utilisation du site',
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Je reconnais avoir lu et accepté l\'ensemble des conditions générales du site.',
                    ]),
                ],
            ])

            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'label' => 'Mot de passe',
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrez un mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit comporter au moins {{ 8 }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
