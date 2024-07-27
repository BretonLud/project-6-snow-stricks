<?php

namespace App\Form;

use App\Entity\Video;
use App\EventSubscriber\VideoFormSubscriber\VideoPreSetDataEventSubscriber;
use App\EventSubscriber\VideoFormSubscriber\VideoSubmitEventSubscriber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VideoFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('videoHost', ChoiceType::class, [
                'choices' => [
                    'Youtube' => 'youtube',
                    'Vimeo' => 'vimeo',
                    'Dailymotion' => 'dailymotion',
                ],
                'required' => true,
                'placeholder' => 'Select a video',
                'row_attr' => [
                    'class' => 'form-floating mb-3',
                ]
            ])
            ->add('videoId', UrlType::class, [
                'required' => true,
                'label' => 'Url video',
                'default_protocol' => "https",
                'row_attr' => [
                    'class' => 'form-floating mb-3',
                ],
                'attr' => [
                    'placeholder' => 'Enter url video',
                ]
            ])
        ;
        
        $builder->addEventSubscriber(new VideoPreSetDataEventSubscriber());
        $builder->addEventSubscriber(new VideoSubmitEventSubscriber());
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Video::class,
        ]);
    }
}
