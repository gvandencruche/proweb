<?php

namespace App\Form;

use App\Entity\Parametre;
use App\Entity\Medias;
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

class ParametreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre',TextType::class, [
                'label' => 'Titre du site',
                'row_attr' => ['class'=>'form-field'],
            ])
            ->add('header', CKEditorType::class, [
                'config_name' => 'config_contact',
                'config'      => array('uiColor' => '#ffffff'),
                'label' => 'Header du site',
                'row_attr' => ['class'=>'form-field'],
                'attr' => ['class'=>'form-control']
            ])
            ->add('accroche', CKEditorType::class, [
                'config_name' => 'config_contact',
                'config'      => array('uiColor' => '#ffffff'),
                'label' => 'Accroche du site',
                'row_attr' => ['class'=>'form-field'],
                'attr' => ['class'=>'form-control']
            ])
            ->add('introTitre',TextType::class, [
                'label' => 'Titre introduction',
                'row_attr' => ['class'=>'form-field'],
            ])
            ->add('introText', CKEditorType::class, [
                'config_name' => 'config_contact',
                'config'      => array('uiColor' => '#ffffff'),
                'label' => 'Texte introduction',
                'row_attr' => ['class'=>'form-field'],
                'attr' => ['class'=>'form-control']
            ])
            ->add('footer',TextType::class, [
                'label' => 'Footer du site',
                'row_attr' => ['class'=>'form-field'],
            ])
            ->add("images", FileType::class, [
                'label'=>"Logo : ",
                'multiple'=>true,
                'mapped'=>false,
                'required'=>false
                
            ])
            ->add('telephone',TelType::class, [
                'label' => 'Téléphone :',
                'row_attr' => ['class'=>'form-field'],
            ])
            ->add('email',EmailType::class, [
                'label' => 'Email :',
                'row_attr' => ['class'=>'form-field'],
            ])
            ->add('adresse', CKEditorType::class, [
                'config_name' => 'config_contact',
                'config'      => array('uiColor' => '#ffffff'),
                'label' => 'Adresse :',
                'row_attr' => ['class'=>'form-field'],
                'attr' => ['class'=>'form-control']
            ])
            ->add('footerLinkedin',TextType::class, [
                'label' => 'Linkedin : ',
                'row_attr' => ['class'=>'form-field'],
            ])
            ->add('footerTitre',TextType::class, [
                'label' => 'Titre du footer : ',
                'row_attr' => ['class'=>'form-field'],
            ])
            ->add('footerText', CKEditorType::class, [
                'config_name' => 'config_contact',
                'config'      => array('uiColor' => '#ffffff'),
                'label' => 'Texte du footer :',
                'row_attr' => ['class'=>'form-field'],
                'attr' => ['class'=>'form-control']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Parametre::class,
        ]);
    }
}
