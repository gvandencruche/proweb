<?php

namespace App\Form;

use App\Entity\Contact;
use App\Entity\Category;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
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
        ->add('phone', TelType::class, [
            'label' => false,
            'row_attr' => ['class'=>'form-field'],
            'attr' => ['placeholder' => 'Votre téléphone','class'=>'form-control']
        ])
        ->add('email', EmailType::class , [
            
            'label' => false,
            'row_attr' => ['class'=>'form-field'],
            'attr' => ['placeholder' => 'Votre email','class'=>'form-control']
        ])
        ->add('message', TextareaType::class, [
            
                'label' => false,
                'row_attr' => ['class'=>'form-field'],
                'attr' => ['placeholder' => 'Taper votre message ici...','class'=>'form-control']
            ])
        ->add('category', EntityType::class, [
                'class' => Category::class,
                'label' => false,
                'row_attr' => ['class'=>'form-field'],
                'attr' => ['placeholder' => 'Votre demande concerne','class'=>'form-control']
            ])
        
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
