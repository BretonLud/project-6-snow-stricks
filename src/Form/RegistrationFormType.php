<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class RegistrationFormType extends PasswordsFormType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        parent::buildForm($builder, $options);
        
        $builder
            ->add('username', TextType::class, [
                'required' => true,
                'attr' => [
                    'autofocus' => true,
                    'class' => 'form-control',
                    'placeholder' => 'Username',
                ],
                'row_attr' => [
                    'class' => 'form-floating mb-3',
                ]
            ])
            ->add('email', EmailType::class, [
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please put an email'
                    ]),
                    new Regex("/^([[a-zA-Z0-9]+[_\.])*([a-zA-Z0-9\-]+)+@([[a-zA-Z0-9]+[.-])*([a-zA-Z0-9]+\.)+[a-z]{2,}$/", "Merci de mettre un email valide"),
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'email@example.com',
                ],
                'row_attr' => [
                    'class' => 'form-floating mb-3',
                ]
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