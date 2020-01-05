<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200105164451 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE travailler DROP FOREIGN KEY FK_90B2DF3D7F26DFC0');
        $this->addSql('DROP INDEX IDX_90B2DF3D7F26DFC0 ON travailler');
        $this->addSql('ALTER TABLE travailler DROP les_visiteurs_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE travailler ADD les_visiteurs_id INT NOT NULL');
        $this->addSql('ALTER TABLE travailler ADD CONSTRAINT FK_90B2DF3D7F26DFC0 FOREIGN KEY (les_visiteurs_id) REFERENCES visiteur (id)');
        $this->addSql('CREATE INDEX IDX_90B2DF3D7F26DFC0 ON travailler (les_visiteurs_id)');
    }
}
