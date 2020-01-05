<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200105165601 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE departement (id INT AUTO_INCREMENT NOT NULL, code_dep VARCHAR(255) NOT NULL, nom_dep VARCHAR(255) NOT NULL, chefvente_dep VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE region (id INT AUTO_INCREMENT NOT NULL, lesecteur_id INT NOT NULL, code_reg VARCHAR(255) NOT NULL, nom_reg VARCHAR(255) NOT NULL, INDEX IDX_F62F176BFAF1EF (lesecteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role_visiteur (role_id INT NOT NULL, visiteur_id INT NOT NULL, INDEX IDX_64766189D60322AC (role_id), INDEX IDX_647661897F72333D (visiteur_id), PRIMARY KEY(role_id, visiteur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE secteur (id INT AUTO_INCREMENT NOT NULL, code_sec VARCHAR(255) NOT NULL, libelle_sec VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE travailler (id INT AUTO_INCREMENT NOT NULL, les_regions_id INT NOT NULL, poste VARCHAR(255) DEFAULT NULL, date_inscription DATE NOT NULL, INDEX IDX_90B2DF3DC3BF2241 (les_regions_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE visiteur (id INT AUTO_INCREMENT NOT NULL, ledepartement_id INT DEFAULT NULL, lesecteur_id INT DEFAULT NULL, matricule VARCHAR(255) NOT NULL, nom_vis VARCHAR(255) NOT NULL, adresse_vis VARCHAR(255) NOT NULL, cp_vis VARCHAR(255) NOT NULL, ville_vis VARCHAR(255) DEFAULT NULL, date_embauche_vis DATE DEFAULT NULL, cover_image VARCHAR(255) NOT NULL, hash VARCHAR(255) DEFAULT NULL, email VARCHAR(255) NOT NULL, INDEX IDX_4EA587B81E2377AB (ledepartement_id), INDEX IDX_4EA587B8BFAF1EF (lesecteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE region ADD CONSTRAINT FK_F62F176BFAF1EF FOREIGN KEY (lesecteur_id) REFERENCES secteur (id)');
        $this->addSql('ALTER TABLE role_visiteur ADD CONSTRAINT FK_64766189D60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE role_visiteur ADD CONSTRAINT FK_647661897F72333D FOREIGN KEY (visiteur_id) REFERENCES visiteur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE travailler ADD CONSTRAINT FK_90B2DF3DC3BF2241 FOREIGN KEY (les_regions_id) REFERENCES region (id)');
        $this->addSql('ALTER TABLE visiteur ADD CONSTRAINT FK_4EA587B81E2377AB FOREIGN KEY (ledepartement_id) REFERENCES departement (id)');
        $this->addSql('ALTER TABLE visiteur ADD CONSTRAINT FK_4EA587B8BFAF1EF FOREIGN KEY (lesecteur_id) REFERENCES secteur (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE visiteur DROP FOREIGN KEY FK_4EA587B81E2377AB');
        $this->addSql('ALTER TABLE travailler DROP FOREIGN KEY FK_90B2DF3DC3BF2241');
        $this->addSql('ALTER TABLE role_visiteur DROP FOREIGN KEY FK_64766189D60322AC');
        $this->addSql('ALTER TABLE region DROP FOREIGN KEY FK_F62F176BFAF1EF');
        $this->addSql('ALTER TABLE visiteur DROP FOREIGN KEY FK_4EA587B8BFAF1EF');
        $this->addSql('ALTER TABLE role_visiteur DROP FOREIGN KEY FK_647661897F72333D');
        $this->addSql('DROP TABLE departement');
        $this->addSql('DROP TABLE region');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE role_visiteur');
        $this->addSql('DROP TABLE secteur');
        $this->addSql('DROP TABLE travailler');
        $this->addSql('DROP TABLE visiteur');
    }
}
