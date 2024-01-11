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
    const NB_USER = 9;
    const NB_SECTEUR = 5;
    const NB_JEUNE = 10;
    const NB_INFOSFORM = 10;
    const NB_ARTICLE = 10;
    const NB_DOCUMENTS = 10;

    public function load(ObjectManager $manager): void
    {
        $faker = FakerFactory::create('fr_FR');

        $secteurNames = ['Clichy-sous-bois', 'Sevran-Rougemont', 'Sevran-Beaudottes', 'Montfermeil', 'Tremblay-en-France'];
        $secteurs = [];
        foreach ($secteurNames as $secteurName) {
            $secteur = new Secteur();
            $secteur
                ->setName($secteurName)
                ->setMobile($faker->phoneNumber)
                ->setMail($faker->email)
                ->setnumber($faker->buildingNumber)
                ->setStreet($faker->streetName)
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
            ->setPassword('$2y$13$MS/eOiG62OpuRNFaYH7ZQ.D2GbTHFv3BiSh29HEuFXNWCvJKe.g0S') /* admin */
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
                ->setPassword('$2y$13$OZp.F8JwLXAshXwmX39xTOfAaph8fvNSSM93MrAiTIGNDgqLQAc/e') /*user */
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
            ->setnumber($faker->buildingNumber)
            ->setStreet($faker->streetName)
            ->setAdditionalAddress($faker->paragraph())
            ->setCity($faker->city)
            ->setZipCode($faker->postcode);

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
            ->setCategorie($faker->randomElement(['Association', 'Rapports d activites','Prevention specialise']));

        $manager->persist($documents);
        }
        $manager->flush();
    }
}
