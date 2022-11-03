<?php

namespace App\Form;
use App\Entity\Menu;
use App\Entity\MenuCategory;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class MenuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('menu_name',TextType::class,[
                'label'=>'Nom du menu',
                'attr' => [
                    'placeholder' => 'ex: menu gourmet',                
                ]
            ])
            ->add('price_menu', TextType::class,[
                'label'=>'Prix du menu',
                'attr' => [
                    'placeholder' => 'ex: 100 euros'
                ]
            ])
            ->add('description', TextareaType::class ,[
                'label'=>'Description du menu',
                'attr' => [
                    'placeholder' => 'Descrivez votre menu, le thème, les saveurs, etc'
                ]
            ])
            ->add('starter', TextType::class,[
                'label'=>'Entrée',
                'attr' => [
                    'placeholder' => 'ex: salade Niçoise'
                ]
            ])
            ->add('main', TextType::class,[
                'label'=>'Plat',
                'attr' => [
                    'placeholder' => 'ex: waffle burger'
                ]
            ])
            ->add('dessert', TextType::class,[
                'label'=>'Dessert',
                'attr' => [
                    'placeholder' => 'ex: moelleux aux 1000 saveurs'
                ]
            ])
            ->add('category', EntityType::class, [
                'label' => 'Catégorie de votre menu',
                'class' => MenuCategory::class,
                'choice_label' => 'category_name'
            ])
            ->add('img1', FileType::class, [
                'mapped' => false,
                'label' => 'Photo menu',
                'help' => 'png, jpg, jpeg, jp2 ou webp - 1 Mo maximum',
                'constraints' => [
                    new Image([
                        'maxSize' => '1M',
                        'maxSizeMessage' => 'Le fichier est trop volumineux ({{ size }} {{ suffix }}). Maximum autorisé : {{ limit }} {{ suffix }}.',
                        'mimeTypes' => [
                            'image/png',
                            'image/jpg',
                            'image/jpeg',
                            'image/jp2',
                            'image/webp',
                        ],
                        'mimeTypesMessage' => 'Merci de sélectionner une image au format {{ types }}.'
                    ])
                ]
                // contraintes
            ])
            ->add('img2', FileType::class, [
                'required' => false,
                'mapped' => false,
                'label' => 'Photo supplementaire',
                'help' => 'png, jpg, jpeg, jp2 ou webp - 1 Mo maximum',
                'constraints' => [
                    new Image([
                        'maxSize' => '1M',
                        'maxSizeMessage' => 'Le fichier est trop volumineux ({{ size }} {{ suffix }}). Maximum autorisé : {{ limit }} {{ suffix }}.',
                        'mimeTypes' => [
                            'image/png',
                            'image/jpg',
                            'image/jpeg'
                        ],
                        'mimeTypesMessage' => 'Merci de sélectionner une image au format {{ types }}.'
                    ])
                ]
            ])
            ->add('img3', FileType::class, [
                'required' => false,
                'mapped' => false,
                'label' => 'Photo supplémentaire',
                'help' => 'png, jpg, jpeg, jp2 ou webp - 1 Mo maximum',
                'constraints' => [ 
                    new Image([
                        'maxSize' => '1M',
                        'maxSizeMessage' => 'Le fichier est trop volumineux ({{ size }} {{ suffix }}). Maximum autorisé : {{ limit }} {{ suffix }}.',
                        'mimeTypes' => [
                            'image/png',
                            'image/jpg',
                            'image/jpeg'
                        ],
                        'mimeTypesMessage' => 'Merci de sélectionner une image au format {{ types }}.'
                    ])
                ]
            ]);
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Menu::class,
        ]);
    }
}
