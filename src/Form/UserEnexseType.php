<?php

namespace App\Form;

use App\Entity\UserEnexse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserEnexseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('username', TextType::class, ['attr' => ['class'=> 'form-control'], 'label' => 'Prénom',])
        ->add('fullname', TextType::class, ['attr' => ['class'=> 'form-control'], 'label' => 'Nom',])
        ->add('gender', ChoiceType::class, [
            'choices' => [
                'Masculin' => 'Male',
                'Feminin' => 'Female',
                'Autres' => 'Orthers'
            ],
            'label' => 'Genre',
            'attr' => ['class'=> 'form-control']
        ])
        ->add('userAdress', TextType::class, ['attr' => ['class'=> 'form-control'],
            'label' => 'Adresse ',])
        ->add('email', EmailType::class)
        ->add('roles', ChoiceType::class, [
            'choices' => [
                'Collaborateur' => 'ROLE_COLLABORATEUR',
                'Administrateur' => 'ROLE_ADMIN',
                'Utilisateur' => 'ROLE_AGENT'
            ],
            'expanded' => true,
            'multiple' => true,
            'label' => 'Rôles',
            'attr' => ['class'=> 'form-control']
        ])
        ->add('dateOfBirth', DateType::class,[
            'widget' => 'single_text',
            // this is actually the default format for single_text
            'format' => 'yyyy-MM-dd',
            'label' => 'Date de Naissance',
        ])
        ->add('userContact', TextType::class, ['attr' => ['class'=> 'form-control'],
            'label' => 'Contact',])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UserEnexse::class,
        ]);
    }
}
