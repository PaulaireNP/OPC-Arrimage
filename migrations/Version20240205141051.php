<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240205141051 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fiche_suivi ADD jeune_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE fiche_suivi ADD CONSTRAINT FK_543C20B015924E15 FOREIGN KEY (jeune_id) REFERENCES jeune (id)');
        $this->addSql('CREATE INDEX IDX_543C20B015924E15 ON fiche_suivi (jeune_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fiche_suivi DROP FOREIGN KEY FK_543C20B015924E15');
        $this->addSql('DROP INDEX IDX_543C20B015924E15 ON fiche_suivi');
        $this->addSql('ALTER TABLE fiche_suivi DROP jeune_id');
    }
}
