# Arrimages
## 🛠️ Technologies utilisées
- [Symfony](https://symfony.com/)
- [Twig](https://twig.symfony.com/)
- [Sass](https://sass-lang.com/)
## 🛠️ Installer les Dépendances
[Installer Symfony](https://symfony.com/doc/current/setup.html/).

[Installer Sass](https://sass-lang.com/install/) avec npm et Node.js :

npm install -g sass

sass --version

[Voir plus de documentation](https://symfony.com/doc/6.2/the-fast-track/fr/22-encore.html/).

Installer webpack encore avec `symfony composer req encore` : package.json et webpack.config.js ont été générés et contiennent une bonne configuration par défaut.

Utiliser Sass : `mv assets/styles/app.css assets/styles/app.scss`
si vous obtenez un message d'erreur, créez un dossier assets/styles/app.css et réessayez.

Ensuite, installer le Sass-loader : `npm install node-sass sass-loader --save-dev` et activer le Sass-loader dans webpack.

Construction des assets : `npx encore dev` et symfony run npm run dev après cela `symfony run -d npm run watch`.




### Back-End

Pour le backend nous allons créé nos **Controller** qu'est-ce qu'un **Controller** ? ça va servir à communiquer avec les modèles -> (Entité + Repository) puis de demander le rendu d'une vue donc en faisant `php bin/console make:controller` nous allons créé notre **Controller** et une **Vue.twig**.

Liste des **Controllers** créé : 

- ActualitesController.php

- ArticleController.php

- AssociationAproposController.php
- AssociationHistoireController.php
- ContactController.php
- DashboardAdminController.php
- DashboardEducateursController.php
- DocumentsController.php
- FormRecrutementContactController.php
- GestionEquipeController.php
- HomeController.php
- InfosFormController.php
- JeuneController.php
- MessagerieController.php
- NavBarDashboardController.php
- NosServicesAccompagnementSocialController.php
- NosServicesActionsCollectivesController.php
- NosServicesAteliersController.php
- NosServicesController.php
- NosServicesTravailDeRueController.php
- SecteurController.php
- SecurityLoginController.php
- TelechargementController.php
- UserController.php

Ensuite nous avons les **Templates** qui ont été créé grâce à notre `php bin/console make:controller` ça nous serviras à générer et afficher du contenu HTML dynamique en combinant des données provenant du contrôleur avec une syntaxe simplifiée.

**Templates** créé :

- actualites
- article
- association_apropos
- association_histoire
- contact
- dashboard_admin
- dashboard_educateurs
- documents
- form_recrutement_contact
- gestion_equipe
- home
- infos_form
- jeune
- layout
- messagerie
- nos_services
- nos_services_accompagnement_social
- nos_services_actions_collectives
- nos_services_ateliers
- nos_services_travail_de_rue
- secteur
- security
- telechargement
- user

Aprés cela nous avons les **Entity** qui vas nous servir à simplifiés la modélisation et la manipulation des données en définissant des objets métier qui sont directement liés à la base de données, donc en faisant la commande `php bin/console make:entity` ça nous génére deux choses une Entité et un Repository.

**Entity** créé :

- Article.php
- Documents.php
- InfosForm.php
- Jeune.php
- Secteur.php
- User.php


Qu'est-ce qu'un **Repository** ça nous serviras à fournir des méthodes permettant d'interagir avec la base de données pour récupérer, persister ou effectuer des requêtes spécifiques liées à une entité.

**Repository** créé :

- ArticleRepository.php
- DocumentsRepository.php
- InfosFormRepository.php
- JeuneRepository.php
- SecteurRepository.php
- UserAdminEducRepository.php
- UserRepository.php

Config **BDD** : 

On vas ensuite configurer notre base de données en créant un fichier .env.local,  un exemple par défaut pour MySQL se trouve en commentaire dans le fichier .env : 

```
Format : driver://user:pass@host:port/dbname?serverVersion=X&charset=utf8mb4
DATABASE_URL="mysql://app:!ChangeMe!@127.0.0.1:3306/app?serverVersion=8&charset=utf8mb4"
```

Par la suite, on va pouvoir créer la base de données avec la commande suivante `php bin/console doctrine:database:create`.

**Fixtures** :

Nous pouvons ensuite installer la dépendance de développement suivante **orm-fixtures** en faisant cette commande : `composer require --dev orm-fixtures`. Ça va nous créés un fichier src/DataFixtures/AppFixtures.php, c'est dans ce fichier qu'on va créer nos fixtures pour générer des données fake, et par la suite c'est grâce à **Faker** que l'on vas créer nos données fake pour remplir notre base de données.

**Faker** :

Qu'est-ce que **Faker** ? 
**Faker** est une librairie qui va nous servir à générer des données fictives réalistes pour remplir la base de données. Pour l'installer il suffit de faire la commande suivante `composer require fakerphp/faker`. Pour l'utiliser, il suffit de suivre la documentation via ce [lien](https://fakerphp.github.io/) ou cet exemple :

```
class AppFixtures extends Fixture
{
    const NB_USER = 19;
    const NB_SECTEUR = 5;
    const NB_JEUNE = 15;
    const NB_INFOSFORM = 10;
    const NB_ARTICLE = 15;
    const NB_DOCUMENTS = 10;

    public function load(ObjectManager $manager): void
    {
        $faker = FakerFactory::create('fr_FR');

        $userAdmin1 = new User();
        $userAdmin1
            ->setEmail('admin@admin.com')
            ->setFirstName('Illan')
            ->setLastName('Cheltiel')
            ->setPassword('$2y$13$MS/eOiG62OpuRNFaYH7ZQ.D2GbTHFv3BiSh29HEuFXNWCvJKe.g0S') /*admin */
            ->setRoles(['ROLE_ADMIN'])
            ->setMobile($faker->phoneNumber)
            ->setnumber($faker->buildingNumber)
            ->setStreet($faker->streetName)
            ->setAdditionalAddress($faker->paragraph())
            ->setCity($faker->city)
            ->setZipCode($faker->postcode);

        $manager->persist($userAdmin1);
}
        $manager->flush();
    }
}
```
#### Authentication / Login
#### Hash de mot de passe
#### Permissions d'accès aux pages selon l'état du user (authentifié ou rôle)
#### Gestion des entités (make:crud)
Qu'est ce qu'un **crud** ?  CRUD est l'acronyme de "Create, Read, Update, Delete", qui sont les quatre opérations de base pour la gestion des données dans une application.

- Create : Créer ou ajouter de nouvelles entrées de données.
- Read (ou Retrieve) : Lire, récupérer, chercher, ou afficher des informations existantes.
- Update : Modifier ou mettre à jour des informations existantes.
- Delete (ou Destroy) : Supprimer des informations existantes.

Les Entités qui ont reçu un crud sont les suivante :

- User.php
- Documents.php
- Article.php

#### Gestion des entités avec des relations.

Relation entre la table User et Secteur pour pouvoir récupèrer tous les secteurs.

#### Personnalisation des formulaires (FormType, FileType, ChoiceType...).

Pour le formType de User j'ai ajouté le code suivant :

```
public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'email',
            ])
           // ->add('roles')
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => ['label' => 'Mot de passe', 'hash_property_path' => 'password',],
                'second_options' => ['label' => 'Confirmer le mot de passe'],
                'mapped' => false,
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Regex([
                        'pattern' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]{8,}$/',
                        'message' => 'Le mot de passe doit contenir au moins une majuscule, une minuscule, un chiffre, un caractère spécial et au moins 8 caractères.'
                    ])
                ]
           ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom',
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Prénom',
            ])
            ->add('mobile', TelType::class, [
                'label' => 'Téléphone',
            ])
            ->add('secteur', EntityType::class, [
                'class' => Secteur::class,
                'choice_label' => 'name',
                'placeholder' => 'Sélectionner un secteur',
            ])
        ;
    }
```

Ceci va consister à préparer le formulaire en lui ajoutant des Type comme pour le champ email, j'ai mis un EmailType qui va indiquer à l'utilisateur qu'il faut remplir par un email.

#### Upload de fichiers (voir la doc)
