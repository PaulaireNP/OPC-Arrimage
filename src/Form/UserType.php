<?php

namespace App\Form;

use App\Entity\Secteur;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'email',
                'required' => true,
            ])
           // ->add('roles')
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => ['label' => 'Mot de passe', 'hash_property_path' => 'password',],
                'second_options' => ['label' => 'Confirmer le mot de passe'],
                'mapped' => false,
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Regex([
                        'pattern' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]{8,}$/',
                        'message' => 'Le mot de passe doit contenir au moins une majuscule, une minuscule, un chiffre, un caractère spécial et au moins 8 caractères.'
                    ])
                ]
           ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom',
                'required' => true,
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Prénom',
                'required' => true,
            ])
            ->add('mobile', TelType::class, [
                'label' => 'Téléphone',
                'required' => true,
            ])
            ->add('secteur', EntityType::class, [
                'class' => Secteur::class,
                'choice_label' => 'name',
                'placeholder' => 'Sélectionner un secteur',
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
