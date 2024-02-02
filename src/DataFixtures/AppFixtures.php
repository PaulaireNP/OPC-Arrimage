<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Documents;
use App\Entity\InfosForm;
use App\Entity\Jeune;
use App\Entity\Secteur;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory as FakerFactory;

class AppFixtures extends Fixture
{
    const NB_USER = 5;
    const NB_JEUNE = 5;
    const NB_INFOSFORM = 5;
    const NB_ARTICLE = 5;
    const NB_DOCUMENTS = 5;

    public function load(ObjectManager $manager): void
    {
        $faker = FakerFactory::create('fr_FR');

        $secteurNames = ['Clichy-sous-bois', 'Sevran', 'Montfermeil', 'Tremblay-en-France'];
        $secteurs = [];
        foreach ($secteurNames as $secteurName) {
            $secteur = new Secteur();
            $secteur
                ->setName($secteurName)
                ->setMobile($faker->phoneNumber)
                ->setMail($faker->email)
                ->setStreet($faker->address())
                ->setAdditionalAddress($faker->paragraph())
                ->setCity($faker->city)
                ->setZipCode($faker->postcode);

            $manager->persist($secteur);
            $secteurs[] = $secteur;
        }

        $userAdmin1 = new User();
        $userAdmin1
            ->setEmail('admin@admin.com')
            ->setFirstName('David')
            ->setLastName('Mehard')
            ->setPassword('$2y$13$MS/eOiG62OpuRNFaYH7ZQ.D2GbTHFv3BiSh29HEuFXNWCvJKe.g0S')/* admin */
            ->setRoles(['ROLE_ADMIN'])
            ->setMobile($faker->phoneNumber)
            ->setCreationDate($faker->dateTimeBetween('-6 months', 'Now'))
            ->setLastModification($faker->dateTimeBetween('-6 months', 'Now'))
            ->setSecteur($faker->randomElement($secteurs));
        $manager->persist($userAdmin1);

        for ($i = 0; $i < self::NB_USER; $i++) {
            $user = new User();
            $user
                ->setEmail($faker->email)
                ->setFirstName($faker->firstName())
                ->setLastName($faker->lastName())
                ->setPassword('$2y$13$OZp.F8JwLXAshXwmX39xTOfAaph8fvNSSM93MrAiTIGNDgqLQAc/e')/*user */
                ->setRoles(['ROLE_USER'])
                ->setMobile($faker->phoneNumber)
                ->setCreationDate($faker->dateTimeBetween('-6 months', 'Now'))
                ->setLastModification($faker->dateTimeBetween('-6 months', 'Now'))
                ->setSecteur($faker->randomElement($secteurs));

            $manager->persist($user);
        }

        for ($i = 0; $i < self::NB_JEUNE; $i++) {
            $jeune = new Jeune();
            $jeune
                ->setLastname($faker->lastName())
                ->setFirstname($faker->firstName())
                ->setMobile($faker->phoneNumber)
                ->setMail($faker->email)
                ->setStreet($faker->address())
                ->setAdditionalAddress($faker->paragraph())
                ->setCity($faker->city)
                ->setZipCode($faker->postcode)
                ->setCreationDate($faker->dateTimeBetween('-6 months', 'Now'))
                ->setLastModification($faker->dateTimeBetween('-6 months', 'Now'))
                ->setSecteur($faker->randomElement($secteurs))
                ->setReferentEduc($faker->randomElement([$user]))
                ->setCoreferentEduc($faker->randomElement([$user]))
                ->setAccompagnement($faker->numberBetween(0, 1))
                ->setTypeAccompagnement($faker->numberBetween(2, 3))
                ->setCivilite($faker->numberBetween(0, 2))
                ->setDob($faker->dateTimeBetween('-6 months', 'Now'))
                ->setQuartier($faker->randomElement(['Clichy-sous-bois', 'Sevran-Rougemont', 'Sevran-Beaudottes', 'Montfermeil', 'Tremblay-en-France']))
                ->setReseaux($faker->randomElement(['Famille', 'Amis', 'Autres']))
                ->setRencontre($faker->numberBetween(0, 5))
                ->setRencontrePrecision($faker->paragraph(1))
                ->setSituationPrecision($faker->paragraph(1));

            // Génére les actions collectives en JSON
            $actionsCollectives = [];
            for ($j = 0; $j < $faker->numberBetween(1, 5); $j++) {
                $action = [
                    'type' => $faker->randomElement(['Chantier pédagogique', 'Séjour', 'Chantier éducatif', 'Sortie']),
                    'description' => $faker->sentence
                ];
                $actionsCollectives[] = $action;
            }
            $jeune
                ->setActionsCollectives((array)json_encode($actionsCollectives))
                ->setActionsCollectivesPrecision($faker->paragraph());

            // Génére la problématique en JSON
            $problematiques = [];
            for ($k = 0; $k < $faker->numberBetween(1, 3); $k++) {
                $problematique = [
                    'type' => $faker->randomElement(['Scolarité', 'Santé', 'Insertion', 'Justice']),
                    'details' => $faker->sentence
                ];
                $problematiques[] = $problematique;
            }
            $jeune
                ->setProblematique((array)json_encode($problematiques))
                ->setProblematiquePrecision($faker->paragraph(1))
                ->setCompteRendu($faker->paragraph(3))
                ->setDemandeJeune($faker->paragraph(3));


            $manager->persist($jeune);
        }

        for ($i = 0; $i < self::NB_INFOSFORM; $i++) {
            $infosForm = new InfosForm();
            $infosForm
                ->setLastname($faker->lastName())
                ->setFirstname($faker->firstName())
                ->setMobile($faker->phoneNumber)
                ->setMail($faker->email)
                ->setnumber($faker->buildingNumber)
                ->setStreet($faker->streetName)
                ->setAdditionalAddress($faker->paragraph())
                ->setCity($faker->city)
                ->setZipCode($faker->postcode);

            $manager->persist($infosForm);
        }

        for ($i = 0; $i < self::NB_ARTICLE; $i++) {
            $article = new Article();
            $article
                ->setTitle($faker->sentence(1))
                ->setDescription($faker->sentence(3))
                ->setImage($faker->image())
                ->setCreationDate($faker->dateTimeBetween('-6 months', '-1 month'))
                ->setUpdateDate($faker->dateTimeBetween('-1 month', 'Now'))
                ->setAuthor('David')
                ->setVisible($faker->boolean(70));

            $manager->persist($article);
        }

        for ($i = 0; $i < self::NB_DOCUMENTS; $i++) {
            $documents = new Documents();
            $documents
                ->setTitle($faker->sentence(1))
                ->setFile($faker->sentence(2))
                ->setVisible($faker->boolean(70))
                ->setCategorie($faker->randomElement(['Association', 'Rapports d activites', 'Prevention specialise']));

            $manager->persist($documents);
        }
        $manager->flush();
    }
}
