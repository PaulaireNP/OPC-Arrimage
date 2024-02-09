<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('image', FileType::class, [
                'label' => 'Image (jpg,jpeg,png)',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '50000k',
                        'mimeTypes' => [
                            'image/jpg',
                            'image/jpeg',
                            'image/png',
                        ],
                        'mimeTypesMessage' => 'Désolé, seulement les fichiers de type JPG, JPEG & PNG sont acceptés.',
                    ])
                ],
            ])
            ->add('author')
            ->add('visible')
            ->add('illustrations', CollectionType::class, [
                'entry_type' => FileType::class,
                'entry_options' => [
                    'label' => 'Image (jpg,jpeg,png)',
                    'mapped' => false,
                    'required' => false,
                    'constraints' => [
                        new File([
                            'maxSize' => '50000k',
                            // mimeTypes Ce sont les types d'images qui sont accéptés au téléchargement
                            'mimeTypes' => [
                                'image/jpg',
                                'image/jpeg',
                                'image/png',
                            ],
                            'mimeTypesMessage' => 'Désolé, seulement les fichiers de type JPG, JPEG & PNG sont acceptés.',
                        ])
                    ],
                ],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label' => false,
                'mapped' => false,
                'required'=> false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
