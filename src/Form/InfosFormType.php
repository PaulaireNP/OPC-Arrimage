<?php

namespace App\Form;

use App\Entity\InfosForm;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InfosFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('lastname')
            ->add('firstname')
            ->add('mobile')
            ->add('mail')
            ->add('number')
            ->add('street')
            ->add('additionalAddress')
            ->add('city')
            ->add('zipCode')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => InfosForm::class,
        ]);
    }
}
