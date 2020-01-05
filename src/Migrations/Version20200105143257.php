<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200105143257 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE travailler (id INT AUTO_INCREMENT NOT NULL, les_regions_id INT NOT NULL, les_visiteurs_id INT NOT NULL, poste VARCHAR(255) DEFAULT NULL, date_inscription DATE NOT NULL, INDEX IDX_90B2DF3DC3BF2241 (les_regions_id), INDEX IDX_90B2DF3D7F26DFC0 (les_visiteurs_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE travailler ADD CONSTRAINT FK_90B2DF3DC3BF2241 FOREIGN KEY (les_regions_id) REFERENCES region (id)');
        $this->addSql('ALTER TABLE travailler ADD CONSTRAINT FK_90B2DF3D7F26DFC0 FOREIGN KEY (les_visiteurs_id) REFERENCES visiteur (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE travailler');
    }
}
