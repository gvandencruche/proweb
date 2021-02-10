<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class , [
                
                'label' => false,
                'row_attr' => ['class'=>'form-field'],
                'attr' => ['placeholder' => 'Votre email','class'=>'form-control']
            ])
            ->add('lastname', TextType::class, [
                'label' => false,
                'row_attr' => ['class'=>'form-field'],
                'attr' => ['placeholder' => 'Votre nom', 'class'=>'form-control']
            ])
            ->add('firstname', TextType::class, [
                'label' => false,
                'row_attr' => ['class'=>'form-field'],
                'attr' => ['placeholder' => 'Votre prénom','class'=>'form-control']
            ])
            ->add('password', RepeatedType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'type' => PasswordType::class,
                'invalid_message' => 'The password fields must match.',
                'options' => ['attr' => ['class' => 'form-control']],
                'required' => true,
                'invalid_message_parameters' => [ 'attr' => ['class' => 'invalid']],
                'first_options'  => ['label' => false, 'attr' => ['class' => 'form-control first']],
                'second_options'  => ['label' => false, 'attr' => ['class' => 'form-control second']],
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
            ])
        ;

        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
