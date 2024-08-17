<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Tricks;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TricksType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'required' => true,
                'row_attr' => [
                    'class' => 'form-floating'
                ],
                'attr' => [
                    'placeholder' => 'Trick Title'
                ]
                
            ])
            ->add('content', HiddenType::class, [
                'required' => true,
                'row_attr' => [
                    'class' => 'form-floating'
                ],
                'attr' => [
                    'placeholder' => 'Trick Content',
                    'data-controller' => 'ckeditor',
                    'data-ckeditor-target' => 'editor'
                ],
                'label' => false,
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'required' => true,
                'autocomplete' => true,
                'placeholder' => 'Select a category',
                'row_attr' => [
                    'class' => 'form-floating'
                ],
            ])
            ->add('pictures', CollectionType::class, [
                'entry_type' => PictureFormType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'label' => false,
                'by_reference' => false,
            ])
            ->add('videos', CollectionType::class, [
                'entry_type' => VideoFormType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'label' => false,
                'by_reference' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tricks::class,
        ]);
    }
}
