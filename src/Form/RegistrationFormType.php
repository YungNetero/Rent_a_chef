<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Doctrine\Common\Annotations\Annotation\Required;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType ;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class,[
                'attr' => [
                'class' =>'form-control'                  
                ],
                'label' => 'E-mail'
            ])  

            ->add('lastname', TextType::class,[
                'attr' =>[
                'class' =>'form-control'  
                ],
                'label' => 'Nom'
            ])

            ->add('firstname', TextType::class,[
                'attr' => [
                'class' =>'form-control'   
                ],
                'label' => 'Prénom'
            ])

            // ->add('address', TextType::class,[])
            // ->add('zipcode', TextType::class,[])
            // ->add('city', TextType::class,[])
            
            ->add('agreeTerms', CheckboxType::class, [
                'label' =>"Termes d'utilisation",
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Veuillez accepter les termes',
                    ]),
                ],
                  
            ])

           //->add('image',FileType::class,[
           //     'required' => false,
           //     'help' => 'image - 2mo maximum',
           //     'constraints' => [
           //         new File([
           //             'maxSize' => '2M',
           //             'maxSizeMessage' => 'Le fichier est trop volumineux ({{ size}} {{ suffix }}). La taille maximale autorisée est de {{limite}} {{ suffix}}',
           //             'mimeTypes' => [
           //                 'image/*'
           //             ],
           //             'mimeTypesMessage' => 'Merci de sélectionner une image au format {{ types }}.'
           //                     ])
           //     ]
           //     
           // ])
            
            
                ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => [
                    'autocomplete' => 'new-password',
                    'class' => 'form-control'
                ],
                
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                          
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
                'label' => 'Mot de passe'
            ])
            ->add('chef', ChoiceType::class, [
                'mapped' => false,
                'label' => 'Êtes-vous un chef ?',
                'choices' => [
                    'non' => 'ROLE_USER',
                    'oui' => 'ROLE_CHEF'
                ],
                'expanded' => true,
                'multiple' => false
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
