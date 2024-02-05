<?php

namespace App\Form;

use App\Entity\FicheSuivi;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FicheSuiviType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('rencontre')
            ->add('creationDate')
            ->add('echange')
            ->add('orientation')
            ->add('echeance')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FicheSuivi::class,
        ]);
    }
}
