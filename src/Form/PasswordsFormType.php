<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class PasswordsFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('plainPassword', RepeatedType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'type' => PasswordType::class,
                'invalid_message' => 'Passwords must be identical.',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Password required',
                    ]),
                    new Length([
                        'min' => 8,
                        'minMessage' => 'Your password must contain at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 50,
                    ]),
                    new Regex('/((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[\W]).{8,64})/',
                        "Your password must contain 1 capital letter, 1 number and 1 special character")
                ],
                'first_options'  => [
                    'label' => 'Password',
                    'attr' => [
                        'placeholder' => 'Password',
                    ],
                    'row_attr' => [
                        'class' => 'form-floating mb-3'
                    ],
                    'toggle' => true,
                    'use_toggle_form_theme' => false
                ],
                'second_options' => [
                    'label' => 'Confirm the password',
                    'attr' => [
                        'placeholder' => 'Confirm the password'
                    ],
                    'row_attr' => [
                        'class' => 'form-floating mb-3'
                    ],
                    'toggle' => true,
                    'use_toggle_form_theme' => false
                ],
               
            ]);
    }
}
