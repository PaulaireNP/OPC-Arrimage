# Hi there 👋

## Project Arrimages

## 🛠️ Tech Stack
- [Symfony](https://symfony.com/)
- [Twig](https://twig.symfony.com/)
- [Sass](https://sass-lang.com/)

## 🛠️ Install Dependencies    
[Install Symfony](https://symfony.com/doc/current/setup.html/).

[Install Sass](https://sass-lang.com/install/) with npm and Node.js :

`npm install -g sass`

`sass --version`

[See more docs](https://symfony.com/doc/6.2/the-fast-track/fr/22-encore.html/).

Install **webpack encore** with `symfony composer req encore` created for you: package.json and webpack.config.js have been generated and contain good default configuration.

Using Sass : `mv assets/styles/app.css assets/styles/app.scss`
if you get an error message create a folder assets/styles/app.css and try again.

then install the sass loader : `npm install node-sass sass-loader --save-dev` and enable the Sass loader in webpack.

Building assets : `npx encore dev` and `symfony run npm run dev` after that `symfony run -d npm run watch`.
