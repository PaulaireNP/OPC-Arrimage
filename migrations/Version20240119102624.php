<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240119102624 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE jeune CHANGE actions_collectives actions_collectives LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', CHANGE situation situation LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', CHANGE problematique problematique LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE jeune CHANGE situation situation JSON NOT NULL, CHANGE actions_collectives actions_collectives JSON NOT NULL, CHANGE problematique problematique JSON NOT NULL');
    }
}
