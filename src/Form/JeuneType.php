<?php

namespace App\Form;

use App\Entity\Jeune;
use App\Entity\Secteur;
use App\Entity\User;
use Doctrine\ORM\Mapping as ORM;
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
use Symfony\Component\Validator\Constraints as Assert;

class JeuneType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('ancien', CheckboxType::class, [
                'label' => 'Ancien',
                'required' => false,
            ])
            ->add('nouveau', CheckboxType::class, [
                'label' => 'Nouveau',
                'required' => false,
            ])
            ->add('regulier', CheckboxType::class, [
                'label' => 'Régulier',
                'required' => false,
            ])
            ->add('polySuivi', ChoiceType::class, [
                'label' => 'Poly suivi',
                'required' => true,
                'expanded' => true,
                'choices' => [
                    'Administratif' => true,
                    'Judiciaire' => false,
                ],
            ])
            ->add('civilite', ChoiceType::class, [
                'label' => 'Civilité',
                'required' => true,
                'expanded' => true,
                'choices' => [
                    'Monsieur' => '1',
                    'Madame' => '2',
                    'Autres' => '0',
                ],
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom',
                'required' => true,
                'attr' => ['placeholder' => 'Entrez votre nom'],
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Prénom',
                'required' => true,
                'attr' => ['placeholder' => 'Entrez votre prénom'],
            ])
            ->add('dob', DateType::class, [
                'label' => 'Date de naissance',
                'required' => true,
                'format' => 'dd MM yyyy',
                'years' => range(date('Y'), date('Y') - 100),
                'attr' => ['placeholder' => 'JJ/MM/AAAA',
                ],
            ])
            ->add('mobile', TelType::class, [
                'label' => 'Téléphone',
                'required' => true,
                'attr' => ['placeholder' => 'Entrez votre numéro de tél.'],
                'constraints' => [
                    new Assert\Regex([
                        'pattern' => '/^(0|\+33)[1-9]([-. ]?[0-9]{2}){4}$/',
                        'message' => 'Le numéro de téléphone doit être au format 0X XX XX XX XX ou +33 X XX XX XX XX'
                    ])
                ]
            ])
            ->add('mail', EmailType::class, [
                'label' => 'Email',
                'required' => true,
                'attr' => ['placeholder' => 'Entrez votre adresse mail'],
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'L\'adresse mail ne peut pas être vide',
                    ]),
                    new Assert\Regex([
                        'pattern' => '/^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/',
                        'message' => 'L\'adresse mail {{ value }} n\'est pas valide',
                    ])
                ]
            ])
            ->add('number', NumberType::class, [
                'label' => 'Numéro de rue',
                'required' => true,
                'attr' => [
                'placeholder' => 'Ex: 123',
                ],
                'constraints' => [
                new Assert\NotBlank([
                    'message' => 'Veuillez entrer un numéro de rue.',
                ]),
                new Assert\Regex([
                    'pattern' => '/^\d+[a-zA-Z]?$/',
                    'message' => 'Veuillez entrer un numéro de rue valide.',
                ]),
            ],
            ])
            ->add('street', TextType::class, [
                'label' => 'Rue',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Ex: Rue des Fleurs',
                ],
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Veuillez entrer le nom de la rue.',
                    ]),
                ],
            ])
            ->add('additionalAddress', TextType::class, [
                'label' => 'Complément d\'adresse',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Complément d\'adresse',
                ],
            ])
            ->add('city', TextType::class, [
                'label' => 'Ville',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Entrez le nom de la ville',
                ],
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Veuillez entrer le nom de la ville.',
                    ]),
                ],
            ])
            ->add('zipCode', TextType::class, [
                'label' => 'Code postal',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Ex: 75001',
                ],
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Veuillez entrer un code postal.',
                    ]),
                    new Assert\Regex([
                        'pattern' => '/^\d{5}$/',
                        'message' => 'Le code postal doit être composé de 5 chiffres.',
                    ]),
                ],
            ])
            ->add('quartier', TextType::class, [
                'label' => 'Quartier',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Entrez le nom du quartier',
                ],
            ])
            ->add('reseaux', TextType::class, [
                'label' => 'Réseaux',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Entrez les réseaux',
                ],
            ])
            ->add('secteur', EntityType::class, [
                'class' => Secteur::class,
                'choice_label' => 'name',
                'placeholder' => 'Sélectionner un secteur',
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Veuillez sélectionner un secteur.',
                    ]),
                ],
            ])
            ->add(('referentEduc'), EntityType::class, [
                'class' => User::class,
                'choice_label' => 'lastname',
                'placeholder' => 'Sélectionner un référent',
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Veuillez sélectionner un référent.',
                    ]),
                ],
                'label' => 'Référent éducatif',
            ])
            ->add('coreferentEduc', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'lastname',
                'placeholder' => 'Sélectionner un co-référent',
                'required' => false,
                'label' => 'Co-référent éducatif',
            ])
            ->add('rencontre', ChoiceType::class, [
                'label' => 'Rencontre',
                'required' => true,
                'expanded' => true,
                'placeholder' => 'Sélectionner une option',
                'choices' => [
                    'PS' => 1,
                    'Famille' => 2,
                    'Copain' => 3,
                    'Collège' => 4,
                    'Partenaire (à préciser)' => 5,
                    'Autres (à préciser)' => 0,
                ],
            ])
            ->add('rencontrePrecision', TextType::class, [
                'label' => 'Précision',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Précisez',
                ],
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Veuillez préciser.',
                    ]),
                ],
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
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Veuillez sélectionner une situation.',
                    ]),
                ],
                'placeholder' => 'Sélectionner une situation',
            ])
            ->add('situationPrecision', TextType::class, [
                'label' => 'Précision',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Précisez',
                ],
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Veuillez préciser.',
                    ]),
                ],
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
                'attr' => [
                    'placeholder' => 'Précisez',
                ],
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Veuillez préciser.',
                    ]),
                ],
            ])
            ->add('compteRendu', TextareaType::class, [
                'label' => 'Compte rendu',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Entrez le compte rendu',
                    'rows' => '10',
                ],
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Veuillez entrer votre compte rendu.',
                    ]),
                ],
            ])
            ->add('demandeJeune', TextareaType::class, [
                'label' => 'Demande du jeune',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Entrez la demande du jeune',
                    'rows' => '10',
                ],
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Veuillez entrer la demande du jeune.',
                    ]),
                ],
            ])
            ->add('problematique', ChoiceType::class, [
                'label' => 'Problématique',
                'required' => true,
                'placeholder' => 'Sélectionner une problématique',
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
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Veuillez sélectionner une problématique.',
                    ]),
                ],
            ])
            ->add('problematiquePrecision', TextType::class, [
                'label' => 'Précision',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Précisez',
                ],
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Veuillez préciser.',
                    ]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Jeune::class,
        ]);
    }
}
