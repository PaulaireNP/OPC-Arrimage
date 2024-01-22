<?php

namespace App\Form;

use App\Entity\Documents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class DocumentsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('categorie', ChoiceType::class, [
                'choices' => [
                    'Association' => 'Association',
                    'Prévention specialisée' => 'Preventionspecialisee',
                    'Rapports d\'activités' => 'Rapportsdactivites'
                ],
                'required' => true,

            ])

            #todo choosetype qui propose seulement les 3 catégories
            ->add('file', FileType::class, [
                'label' => 'Fichiers (pdf,docx,odt,xlsx,ods)',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '50000k',
                        'mimeTypes' => [
                            'application/pdf',
                            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                            'application/vnd.oasis.opendocument.text',
                            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                            'application/vnd.oasis.opendocument.spreadsheet',
                        ],
                        'mimeTypesMessage' => 'Desolé, seulement les fichiers de type PDF, DOCX, ODT, XLSX & ODS sont acceptés.',
                    ])
                ],
            ])
            ->add('visible')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Documents::class,
        ]);
    }
}
