<?php

namespace App\Form;

use App\Entity\Menu;
use App\Entity\MenuImg;
use App\Form\MenuImgType;
use App\Entity\MenuCategory;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class MenuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('menu_name')
            ->add('price_menu')
            ->add('description')
            ->add('starter')
            ->add('main')
            ->add('dessert')
            ->add('category', EntityType::class, [
                'class' => MenuCategory::class,
                'choice_label' => 'category_name'
            ])
            ->add('img1', FileType::class, [
                'mapped' => false
            ])
            ->add('img2', FileType::class, [
                'mapped' => false
            ])
            ->add('img3', FileType::class, [
                'mapped' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Menu::class,
        ]);
    }
}
