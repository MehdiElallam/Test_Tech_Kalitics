<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210228123547 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE chantier (id INT AUTO_INCREMENT NOT NULL, pointages_id INT DEFAULT NULL, nom VARCHAR(60) NOT NULL, adresse LONGTEXT NOT NULL, date_debut DATETIME NOT NULL, INDEX IDX_636F27F684925C5D (pointages_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pointage (id INT AUTO_INCREMENT NOT NULL, date_pointage DATETIME NOT NULL, duree INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE chantier ADD CONSTRAINT FK_636F27F684925C5D FOREIGN KEY (pointages_id) REFERENCES pointage (id)');
        $this->addSql('DROP TABLE chantiers');
        $this->addSql('DROP TABLE pointages');
        $this->addSql('ALTER TABLE user ADD pointages_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64984925C5D FOREIGN KEY (pointages_id) REFERENCES pointage (id)');
        $this->addSql('CREATE INDEX IDX_8D93D64984925C5D ON user (pointages_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chantier DROP FOREIGN KEY FK_636F27F684925C5D');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64984925C5D');
        $this->addSql('CREATE TABLE chantiers (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(60) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, adresse LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, date_debut DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE pointages (id INT AUTO_INCREMENT NOT NULL, date_pointage DATETIME NOT NULL, duree INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE chantier');
        $this->addSql('DROP TABLE pointage');
        $this->addSql('DROP INDEX IDX_8D93D64984925C5D ON user');
        $this->addSql('ALTER TABLE user DROP pointages_id');
    }
}
