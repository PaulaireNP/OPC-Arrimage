<?php

namespace App\Form;

use App\Entity\Jeune;
use App\Entity\Secteur;
use App\Entity\User;
use JsonToBooleanTransformer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Range;

class JeuneType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('ancien', CheckboxType::class, [
                'label' => 'Ancien',
                'required' => true,
            ])
            ->add('regulier', CheckboxType::class, [
                'label' => 'Régulier',
                'required' => true,
            ])
            ->add('polySuivi', CheckboxType::class, [
                'label' => 'Poly suivi',
                'required' => true,
            ])
            ->add('civilite', CheckboxType::class, [
                'label' => 'Civilité',
                'required' => true,
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom',
                'required' => true,
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Prénom',
                'required' => true,
            ])
            ->add('dob', DateType::class, [
                'label' => 'Date de naissance',
                'required' => true,
                'html5' => false,
                'format' => 'dd/MM/yyyy',
                'attr' => ['placeholder' => 'JJ/MM/AAAA',
                    ],
                'constraints' => [
                    new Range([
                        'max' => new \DateTime('today'),
                        'min' => new \DateTime('01/01/1900'),
                    ])
                ]
            ])
            ->add('mobile', TelType::class, [
                'label' => 'Téléphone',
            ])
            ->add('mail', EmailType::class, [
                'label' => 'email',
            ])
            ->add('number', NumberType::class, [
            'label' => 'Numéro'
            ])
            ->add('street', TextType::class, [
                'label' => 'Rue',
            ])
            ->add('additionalAddress', TextType::class, [
                'label' => 'Complément d\'adresse',
                'required' => false,
            ])
            ->add('city', TextType::class, [
                'label' => 'Ville',
            ])
            ->add('zipCode', TextType::class, [
                'label' => 'Code postal',
            ])
            ->add('quartier', TextType::class, [
                'label' => 'Quartier',
            ])
            ->add('reseaux', TextType::class, [
                'label' => 'Réseaux',
            ])
            ->add('secteur', EntityType::class, [
                'class' => Secteur::class,
                'choice_label' => 'name',
                'placeholder' => 'Sélectionner un secteur',
            ])
            ->add(('referentEduc'), EntityType::class, [
                'class' => User::class,
                'choice_label' => 'lastname',
                'placeholder' => 'Sélectionner un référent',
            ])
            ->add('coreferentEduc', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'lastname',
                'placeholder' => 'Sélectionner un co-référent',
                'required' => false,
            ])
            ->add('rencontre', CheckboxType::class, [
                'label' => 'Rencontre',
                'required' => true,
            ])
            ->add('rencontrePrecision', TextType::class, [
                'label' => 'Précision',
                'required' => false,
            ])
            ->add('situation', ChoiceType::class, [
                'label' => 'Situation',
                'required' => true,
                'choices' => [
                    'CNI/Titre de séjour' => 1,
                    'Carte vitale' => 2,
                    'AME' => 3,
                    'Scolarisé' => 4,
                    'Déscolarisé' => 5,
                    'En emploi (à préciser)' => 6,
                    'MLE (conseiller réf.)' => 7,
                    'Pôle emploi' => 8,
                    'Minima-sociaux(RSA, API...)' => 9,
                    'PJJ(Educ. réf.)' => 10,
                    'SPIP (Réfèrent)' => 11,
                    'Entreprise intermédiaire' => 12,
                    'Autres' => 0,
                ],
                'expanded' => true,
                'multiple' => true,
            ])
            ->add('situationPrecision', TextType::class, [
                'label' => 'Précision',
                'required' => false,
            ])
            ->add('actionsCollectives', ChoiceType::class, [
                'label' => 'Actions collectives',
                'required' => true,
                'choices' => [
                    'Chantier pédagogique' => 1,
                    'Séjour' => 2,
                    'Chantier éducatif' => 3,
                    'Sortie' => 4,
                    'Quartier amélioration cadre de vie' => 5,
                    'Autres' => 0,
                ],
                'expanded' => true,
                'multiple' => true,
            ])
            ->add('actionsCollectivesPrecision', TextType::class, [
                'label' => 'Précision',
                'required' => false,
            ])
            ->add('compteRendu', TextareaType::class, [
                'label' => 'Compte rendu',
                'required' => true,
            ])
            ->add('demandeJeune', TextareaType::class, [
                'label' => 'Demande du jeune',
                'required' => true,
            ])
            ->add('problematique', ChoiceType::class, [
                'label' => 'Problématique',
                'required' => true,
                'choices' => [
                    'Scolarité' => 1,
                    'Santé' => 2,
                    'Insertion' => 3,
                    'Justice' => 4,
                    'Loisirs' => 5,
                    'Accès aux droits' => 6,
                    'Autres' => 0,
                ],
                'expanded' => true,
                'multiple' => true,
            ])
            ->add('problematiquePrecision', TextType::class, [
                'label' => 'Précision',
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Jeune::class,
        ]);
    }
}
