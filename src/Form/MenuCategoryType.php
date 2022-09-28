<?php

namespace App\Form;

use App\Entity\MenuCategory;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class MenuCategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)

    {
        $builder
            ->add('category_name', TextType::class)
            ->add('Img', FileType::class, array(
                'mapped' => false,
                'label' => 'ajouter image'
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MenuCategory::class,
        ]);
    }
}
