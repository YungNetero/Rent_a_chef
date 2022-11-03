<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;



class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'attr' => [
                    'maxLength' => 45
                ]
            ])
            ->add('lastname', TextType::class, [
                'attr' => [
                    'maxLength' => 45
                ]
            ])

            ->add('email', EmailType::class, [
                'attr' => [
                    'maxLength' => 100
                ]
            ])
            ->add('subject', ChoiceType::class, [
                'choices' => [
                    '-- sélectionner --' => '',
                    'signaler un bug' => 'bug',
                    'postuler' => 'postuler',
                    'SAV' => 'sav',
                    'autre' => 'autre'
                ]
            ])

            ->add('message', TextareaType::class, [
                'attr' => [
                    'minLenght' => 25,
                    'maxLength' => 2000
                ]
            ])

            ->add('attachement', FileType::class,[
                'required' => false,
                'help' => 'image ou document PDF - 2mo maximum',
                'constraints' => [
                    new File([
                        'maxSize' => '2M',
                        'maxSizeMessage' => 'Le fichier est trop volumineux ({{ size}} {{ suffix }}). La taille maximale autorisée est de {{limite}} {{ suffix}}',
                        'mimeTypes' => [
                            'image/*'
                        ],
                        'mimeTypesMessage' => 'Merci de sélectionner une image au format {{ types }}.'
                        
                    ])
                ]
            ])

            ->add('honeypot', HiddenType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
