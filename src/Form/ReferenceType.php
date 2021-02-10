<?php

namespace App\Form;

use App\Entity\Reference;
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
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\DateType;


class ReferenceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre',TextType::class, [
                'label' => 'Titre reference :',
                'row_attr' => ['class'=>'form-field'],
            ])
            ->add('text', CKEditorType::class, [
                'config_name' => 'config_contact',
                'config'      => array('uiColor' => '#ffffff'),
                'label' => 'Texte référence : ',
                'row_attr' => ['class'=>'form-field'],
                'attr' => ['class'=>'form-control']
            ])
            ->add('poste', CKEditorType::class, [
                'config_name' => 'config_contact',
                'config'      => array('uiColor' => '#ffffff'),
                'label' => 'Postes référence : ',
                'row_attr' => ['class'=>'form-field'],
                'attr' => ['class'=>'form-control']
            ])
            ->add('realisation', CKEditorType::class, [
                'config_name' => 'config_contact',
                'config'      => array('uiColor' => '#ffffff'),
                'label' => 'Réalisation référence : ',
                'row_attr' => ['class'=>'form-field'],
                'attr' => ['class'=>'form-control']
            ])
            ->add('technologies', CKEditorType::class, [
                'config_name' => 'config_contact',
                'config'      => array('uiColor' => '#ffffff'),
                'label' => 'Technologies référence : ',
                'row_attr' => ['class'=>'form-field'],
                'attr' => ['class'=>'form-control']
            ])
            ->add('datedebut', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date début mission : ',
                'attr' => ['class' => 'js-datepicker'],
            ])
            ->add('datefin', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date fin mission : ',
                'attr' => ['class' => 'js-datepicker'],
            ])
            ->add('url',TextType::class, [
                'label' => 'Url reference :',
                'row_attr' => ['class'=>'form-field'],
            ])
            ->add("images", FileType::class, [
                'label'=>"Logo : ",
                'multiple'=>true,
                'mapped'=>false,
                'required'=>false
                
            ])
        ;
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reference::class,
        ]);
    }
}
