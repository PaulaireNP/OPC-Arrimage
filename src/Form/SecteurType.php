<?php

namespace App\Form;

use App\Entity\Secteur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class SecteurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom',
            ])
            ->add('mobile', TextType::class, [
                'label' => 'Mobile',
            ])
            ->add('mail', TextType::class, [
                'label' => 'Email',
            ])
            ->add('number', TextType::class, [
                'label' => 'Numéro de rue',
            ])
            ->add('street', TextType::class, [
                'label' => 'Rue',
            ])
            ->add('additionalAddress', TextType::class, [
                'label' => 'Complément d\'adresse',
            ])
            ->add('city', TextType::class, [
                'label' => 'Ville',
            ])
            ->add('zipCode', TextType::class, [
                'label' => 'Code Postal',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Secteur::class,
        ]);
    }
}
