<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191126094340 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE visiteur (id INT AUTO_INCREMENT NOT NULL, ledepartement_id INT DEFAULT NULL, lesecteur_id INT DEFAULT NULL, matricule VARCHAR(255) NOT NULL, nom_vis VARCHAR(255) NOT NULL, adresse_vis VARCHAR(255) NOT NULL, cp_vis VARCHAR(255) NOT NULL, ville_vis VARCHAR(255) NOT NULL, date_embauche_vis DATE NOT NULL, INDEX IDX_4EA587B81E2377AB (ledepartement_id), INDEX IDX_4EA587B8BFAF1EF (lesecteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE visiteur ADD CONSTRAINT FK_4EA587B81E2377AB FOREIGN KEY (ledepartement_id) REFERENCES departement (id)');
        $this->addSql('ALTER TABLE visiteur ADD CONSTRAINT FK_4EA587B8BFAF1EF FOREIGN KEY (lesecteur_id) REFERENCES secteur (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE visiteur');
    }
}
