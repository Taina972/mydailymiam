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
                'label'=>'email',
                'attr' =>[
                    'placeholder' =>'Entrez votre email'
                ]
            ]) 

             ->add('lastname', TextType::class,[
                 'label' => 'lastname',
                 'attr' =>[
                     'placeholder' =>'Votre nom'
                 ]
             ]) 
             
             ->add('firstname', TextType::class,[
                'label' => 'firstname',
                'attr' =>[
                    'placeholder' =>'Votre prénom'
                ]
            ])  

            ->add('birthday', BirthdayType::class,[
                'label' => 'birthday',
                'attr' =>[
                    'placeholder' =>'Votre date de naissance'
                ]
            ])  

            ->add('city', TextType::class,[
                'label' => 'city',
                'attr' =>[
                    'placeholder' =>'Votre ville'
                ]
            ])  

            ->add('zipcode', TextType::class,[
                'label' => 'zipcode',
                'attr' =>[
                    'placeholder' =>'Votre code postal'
                ]
            ])  

            ->add('country', TextType::class,[
                'label' => 'country',
                'attr' =>[
                    'placeholder' =>'Votre pays'
                ]
            ])  

            ->add('pp', TextType::class,[
                'label' => 'pp',
                'attr' =>[
                    'placeholder' =>'Choisissez votre avatar'
                ]
            ])  

            ->add('agreeTerms', CheckboxType::class, [
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
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrez un mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit comporter au moins {{ 12 }} caractères',
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
