<?php

namespace App\Form;

use App\Entity\Picture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Image;

class PictureFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $picture = $event->getData();
            $form = $event->getForm();
            
            $form
                ->add('file', FileType::class, [
                    'required' => null === $picture || null === $picture->getId(),
                    'constraints' => [
                        new File([
                            'maxSize' => '2048k',
                            'mimeTypes' => ['image/jpeg', 'image/png', 'image/webp'],
                            'mimeTypesMessage' => 'Please upload a valid image file.',
                        ]),
                        new Image(),
                    ],
                    'label' => false,
                ])
                ->add('header', CheckboxType::class, [
                    'required' => false,
                    'row_attr' => [
                        'class' => 'form-switch ps-3'
                    ],
                ])
                ->add('index', HiddenType::class);
        });
    }
    
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Picture::class,
        ]);
    }
}
