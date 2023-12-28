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

#### Créations des Entités
#### (Fixtures avec Faker)
#### Authentication / Login
#### Hash de mot de passe
#### Permissions d'accès aux pages selon l'état du user (authentifié ou rôle)
#### Gestion des entités (make:crud)
#### Gestion des entités avec des relations
#### Personnalisation des formulaires (FormType, FileType, ChoiceType...)
#### Upload de fichiers (voir la doc)
