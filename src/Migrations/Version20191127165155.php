<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191127165155 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F4F34D596');
        $this->addSql('ALTER TABLE role_user DROP FOREIGN KEY FK_332CA4DDD60322AC');
        $this->addSql('ALTER TABLE ad DROP FOREIGN KEY FK_77E0ED58F675F31B');
        $this->addSql('ALTER TABLE role_user DROP FOREIGN KEY FK_332CA4DDA76ED395');
        $this->addSql('CREATE TABLE departement (id INT AUTO_INCREMENT NOT NULL, code_dep VARCHAR(255) NOT NULL, nom_dep VARCHAR(255) NOT NULL, chefvente_dep VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE region (id INT AUTO_INCREMENT NOT NULL, lesecteur_id INT NOT NULL, code_reg VARCHAR(255) NOT NULL, nom_reg VARCHAR(255) NOT NULL, INDEX IDX_F62F176BFAF1EF (lesecteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE secteur (id INT AUTO_INCREMENT NOT NULL, code_sec VARCHAR(255) NOT NULL, libelle_sec VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE visiteur (id INT AUTO_INCREMENT NOT NULL, ledepartement_id INT DEFAULT NULL, lesecteur_id INT DEFAULT NULL, matricule VARCHAR(255) NOT NULL, nom_vis VARCHAR(255) NOT NULL, adresse_vis VARCHAR(255) NOT NULL, cp_vis VARCHAR(255) NOT NULL, ville_vis VARCHAR(255) NOT NULL, date_embauche_vis DATE NOT NULL, INDEX IDX_4EA587B81E2377AB (ledepartement_id), INDEX IDX_4EA587B8BFAF1EF (lesecteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE region ADD CONSTRAINT FK_F62F176BFAF1EF FOREIGN KEY (lesecteur_id) REFERENCES secteur (id)');
        $this->addSql('ALTER TABLE visiteur ADD CONSTRAINT FK_4EA587B81E2377AB FOREIGN KEY (ledepartement_id) REFERENCES departement (id)');
        $this->addSql('ALTER TABLE visiteur ADD CONSTRAINT FK_4EA587B8BFAF1EF FOREIGN KEY (lesecteur_id) REFERENCES secteur (id)');
        $this->addSql('DROP TABLE ad');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE role_user');
        $this->addSql('DROP TABLE user');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE visiteur DROP FOREIGN KEY FK_4EA587B81E2377AB');
        $this->addSql('ALTER TABLE region DROP FOREIGN KEY FK_F62F176BFAF1EF');
        $this->addSql('ALTER TABLE visiteur DROP FOREIGN KEY FK_4EA587B8BFAF1EF');
        $this->addSql('CREATE TABLE ad (id INT AUTO_INCREMENT NOT NULL, author_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, slug VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, price DOUBLE PRECISION NOT NULL, introduction LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, content LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, cover_image VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, rooms INT NOT NULL, INDEX IDX_77E0ED58F675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, ad_id INT NOT NULL, url VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, caption VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, INDEX IDX_C53D045F4F34D596 (ad_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE role_user (role_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_332CA4DDD60322AC (role_id), INDEX IDX_332CA4DDA76ED395 (user_id), PRIMARY KEY(role_id, user_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, last_name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, email VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, picture VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, hash VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, introduction VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, description LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, slug VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE ad ADD CONSTRAINT FK_77E0ED58F675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F4F34D596 FOREIGN KEY (ad_id) REFERENCES ad (id)');
        $this->addSql('ALTER TABLE role_user ADD CONSTRAINT FK_332CA4DDA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE role_user ADD CONSTRAINT FK_332CA4DDD60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE departement');
        $this->addSql('DROP TABLE region');
        $this->addSql('DROP TABLE secteur');
        $this->addSql('DROP TABLE visiteur');
    }
}
