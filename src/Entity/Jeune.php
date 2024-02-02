<?php

namespace App\Entity;

use App\Repository\JeuneRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JeuneRepository::class)]
class Jeune
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $lastname = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $mobile = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $mail = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $street = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $additionalAddress = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $city = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $zipCode = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $creationDate = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $lastModification = null;

    #[ORM\Column]
    private ?int $civilite = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dob = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $quartier = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $reseaux = null;

    #[ORM\ManyToOne(inversedBy: 'jeunes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Secteur $secteur = null;

    #[ORM\ManyToOne(inversedBy: 'jeunes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $referentEduc = null;

    #[ORM\ManyToOne(inversedBy: 'cojeunes')]
    private ?User $coreferentEduc = null;

    #[ORM\Column]
    private ?int $rencontre = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $rencontrePrecision = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $actionsCollectivesPrecision = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $compteRendu = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $demandeJeune = null;

    #[ORM\Column(type: Types::ARRAY)]
    private array $situation = [];

    #[ORM\Column(type: Types::ARRAY)]
    private array $actionsCollectives = [];

    #[ORM\Column(type: Types::ARRAY)]
    private array $problematique = [];

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $situationPrecision = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $ProblematiquePrecision = null;

    #[ORM\Column]
    private ?int $accompagnement = null;

    #[ORM\Column(nullable: true)]
    private ?int $typeAccompagnement = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $reseauxPrecision = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getMobile(): ?string
    {
        return $this->mobile;
    }

    public function setMobile(?string $mobile): static
    {
        $this->mobile = $mobile;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(?string $mail): static
    {
        $this->mail = $mail;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(?string $street): static
    {
        $this->street = $street;

        return $this;
    }

    public function getAdditionalAddress(): ?string
    {
        return $this->additionalAddress;
    }

    public function setAdditionalAddress(?string $additionalAddress): static
    {
        $this->additionalAddress = $additionalAddress;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    public function setZipCode(?string $zipCode): static
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creationDate;
    }

    public function setCreationDate(\DateTimeInterface $creationDate): static
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    public function getLastModification(): ?\DateTimeInterface
    {
        return $this->lastModification;
    }

    public function setLastModification(\DateTimeInterface $lastModification): static
    {
        $this->lastModification = $lastModification;

        return $this;
    }

    public function getCivilite(): ?int
    {
        return $this->civilite;
    }

    public function setCivilite(int $civilite): static
    {
        $this->civilite = $civilite;

        return $this;
    }

    public function getDob(): ?\DateTimeInterface
    {
        return $this->dob;
    }

    public function setDob(?\DateTimeInterface $dob): static
    {
        $this->dob = $dob;

        return $this;
    }

    public function getQuartier(): ?string
    {
        return $this->quartier;
    }

    public function setQuartier(?string $quartier): static
    {
        $this->quartier = $quartier;

        return $this;
    }

    public function getReseaux(): ?string
    {
        return $this->reseaux;
    }

    public function setReseaux(?string $reseaux): static
    {
        $this->reseaux = $reseaux;

        return $this;
    }

    public function getSecteur(): ?Secteur
    {
        return $this->secteur;
    }

    public function setSecteur(?Secteur $secteur): static
    {
        $this->secteur = $secteur;

        return $this;
    }

    public function getReferentEduc(): ?User
    {
        return $this->referentEduc;
    }

    public function setReferentEduc(?User $referentEduc): static
    {
        $this->referentEduc = $referentEduc;

        return $this;
    }

    public function getCoreferentEduc(): ?User
    {
        return $this->coreferentEduc;
    }

    public function setCoreferentEduc(?User $coreferentEduc): static
    {
        $this->coreferentEduc = $coreferentEduc;

        return $this;
    }

    public function getRencontre(): ?int
    {
        return $this->rencontre;
    }
    public function getRencontreAsStrings(): string {
        $mapping = [
            1 => 'PS',
            2 => 'Famille',
            3 => 'Copain',
            4 => 'Collège',
            5 => 'Partenaire',
            0 => 'Autres',
        ];
        return $mapping[$this->rencontre] ?? 'Inconnu';
    }

    public function setRencontre(int $rencontre): static
    {
        $this->rencontre = $rencontre;

        return $this;
    }

    public function getRencontrePrecision(): ?string
    {
        return $this->rencontrePrecision;
    }

    public function setRencontrePrecision(?string $rencontrePrecision): static
    {
        $this->rencontrePrecision = $rencontrePrecision;

        return $this;
    }

    public function getActionsCollectivesPrecision(): ?string
    {
        return $this->actionsCollectivesPrecision;
    }

    public function setActionsCollectivesPrecision(?string $actionsCollectivesPrecision): static
    {
        $this->actionsCollectivesPrecision = $actionsCollectivesPrecision;

        return $this;
    }

    public function getCompteRendu(): ?string
    {
        return $this->compteRendu;
    }

    public function setCompteRendu(?string $compteRendu): static
    {
        $this->compteRendu = $compteRendu;

        return $this;
    }

    public function getDemandeJeune(): ?string
    {
        return $this->demandeJeune;
    }

    public function setDemandeJeune(?string $demandeJeune): static
    {
        $this->demandeJeune = $demandeJeune;

        return $this;
    }

    public function getSituation(): array
    {
        return $this->situation;
    }

    public function getSituationAsStrings(): array
    {
        $mapping = [
            1 => 'CNI/Titre de séjour',
            2 => 'Carte vitale',
            3 => 'AME',
            4 => 'Scolarisé',
            5 => 'Déscolarisé',
            6 => 'En emploi',
            7 => 'MLE',
            8 => 'Pôle emploi',
            9 => 'Minima-sociaux',
            10 => 'PJJ',
            11 => 'SPIP',
            12 => 'Entreprise intermédiaire',
            0 => 'Autres',
        ];

        return array_map(function($situation) use ($mapping)
        {
            return $mapping[$situation] ?? 'Inconnu';
        },
            $this->situation);
    }

    public function setSituation(array $situation): static
    {
        $this->situation = $situation;

        return $this;
    }

    public function getActionsCollectives(): array
    {
        return $this->actionsCollectives;
    }

    public function getActionsCollectivesAsStrings(): array
    {
        $mapping = [
            1 => 'Chantier pédagogique',
            2 => 'Séjour',
            3 => 'Chantier éducatif',
            4 => 'Sortie',
            5 => 'Quartier amélioration cadre de vie',
            0 => 'Autres',
        ];

        return array_map(function($action) use ($mapping)
            {
                return $mapping[$action] ?? 'Inconnu';
            },
                $this->actionsCollectives);
    }

    public function setActionsCollectives(array $actionsCollectives): static
    {
        $this->actionsCollectives = $actionsCollectives;

        return $this;
    }

    public function getProblematique(): array
    {
        return $this->problematique;
    }

public function getProblematiqueAsStrings(): array
    {
        $mapping = [
            1 => 'Scolarité',
            2 => 'Santé',
            3 => 'Insertion',
            4 => 'Justice',
            5 => 'Loisirs',
            6 => 'Accès aux droits',
            0 => 'Autres',
        ];

        return array_map(function($problematique) use ($mapping)
            {
                return $mapping[$problematique] ?? 'Inconnu';
            },
                $this->problematique);
    }

    public function setProblematique(array $problematique): static
    {
        $this->problematique = $problematique;

        return $this;
    }

    public function getSituationPrecision(): ?string
    {
        return $this->situationPrecision;
    }

    public function setSituationPrecision(?string $situationPrecision): static
    {
        $this->situationPrecision = $situationPrecision;

        return $this;
    }

    public function getProblematiquePrecision(): ?string
    {
        return $this->ProblematiquePrecision;
    }

    public function setProblematiquePrecision(?string $ProblematiquePrecision): static
    {
        $this->ProblematiquePrecision = $ProblematiquePrecision;

        return $this;
    }

    public function getAccompagnement(): ?int
    {
        return $this->accompagnement;
    }

    public function setAccompagnement(int $accompagnement): static
    {
        $this->accompagnement = $accompagnement;

        return $this;
    }

    public function getTypeAccompagnement(): ?int
    {
        return $this->typeAccompagnement;
    }

    public function setTypeAccompagnement(int $typeAccompagnement): static
    {
        $this->typeAccompagnement = $typeAccompagnement;

        return $this;
    }

    public function getReseauxPrecision(): ?string
    {
        return $this->reseauxPrecision;
    }

    public function setReseauxPrecision(?string $reseauxPrecision): static
    {
        $this->reseauxPrecision = $reseauxPrecision;

        return $this;
    }
}
