<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240201145144 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, author VARCHAR(255) DEFAULT NULL, visible TINYINT(1) DEFAULT NULL, update_date DATETIME NOT NULL, creation_date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE documents (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, file VARCHAR(255) DEFAULT NULL, visible TINYINT(1) NOT NULL, categorie VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE infos_form (id INT AUTO_INCREMENT NOT NULL, lastname VARCHAR(255) DEFAULT NULL, firstname VARCHAR(255) DEFAULT NULL, mobile VARCHAR(255) DEFAULT NULL, mail VARCHAR(255) DEFAULT NULL, number VARCHAR(255) DEFAULT NULL, street VARCHAR(255) DEFAULT NULL, additional_address VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, zip_code VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE jeune (id INT AUTO_INCREMENT NOT NULL, secteur_id INT NOT NULL, referent_educ_id INT NOT NULL, coreferent_educ_id INT DEFAULT NULL, lastname VARCHAR(255) DEFAULT NULL, firstname VARCHAR(255) DEFAULT NULL, mobile VARCHAR(255) DEFAULT NULL, mail VARCHAR(255) DEFAULT NULL, street VARCHAR(255) DEFAULT NULL, additional_address VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, zip_code VARCHAR(255) DEFAULT NULL, creation_date DATETIME NOT NULL, last_modification DATETIME NOT NULL, civilite INT NOT NULL, dob DATE DEFAULT NULL, quartier VARCHAR(255) DEFAULT NULL, reseaux VARCHAR(255) DEFAULT NULL, rencontre INT NOT NULL, rencontre_precision VARCHAR(255) DEFAULT NULL, actions_collectives_precision VARCHAR(255) DEFAULT NULL, compte_rendu LONGTEXT DEFAULT NULL, demande_jeune LONGTEXT DEFAULT NULL, situation LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', actions_collectives LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', problematique LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', situation_precision VARCHAR(255) DEFAULT NULL, problematique_precision VARCHAR(255) DEFAULT NULL, accompagnement INT NOT NULL, type_accompagnement INT DEFAULT NULL, reseaux_precision VARCHAR(255) DEFAULT NULL, INDEX IDX_8DC4E6859F7E4405 (secteur_id), INDEX IDX_8DC4E6856ED8EC8A (referent_educ_id), INDEX IDX_8DC4E6855D52197B (coreferent_educ_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE secteur (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, mobile VARCHAR(255) DEFAULT NULL, mail VARCHAR(255) DEFAULT NULL, street VARCHAR(255) DEFAULT NULL, additional_address VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, zip_code VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, secteur_id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, lastname VARCHAR(255) DEFAULT NULL, firstname VARCHAR(255) DEFAULT NULL, mobile VARCHAR(255) DEFAULT NULL, creation_date DATETIME NOT NULL, last_modification DATETIME NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D6499F7E4405 (secteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE jeune ADD CONSTRAINT FK_8DC4E6859F7E4405 FOREIGN KEY (secteur_id) REFERENCES secteur (id)');
        $this->addSql('ALTER TABLE jeune ADD CONSTRAINT FK_8DC4E6856ED8EC8A FOREIGN KEY (referent_educ_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE jeune ADD CONSTRAINT FK_8DC4E6855D52197B FOREIGN KEY (coreferent_educ_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D6499F7E4405 FOREIGN KEY (secteur_id) REFERENCES secteur (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE jeune DROP FOREIGN KEY FK_8DC4E6859F7E4405');
        $this->addSql('ALTER TABLE jeune DROP FOREIGN KEY FK_8DC4E6856ED8EC8A');
        $this->addSql('ALTER TABLE jeune DROP FOREIGN KEY FK_8DC4E6855D52197B');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D6499F7E4405');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE documents');
        $this->addSql('DROP TABLE infos_form');
        $this->addSql('DROP TABLE jeune');
        $this->addSql('DROP TABLE secteur');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
