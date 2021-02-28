<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210228173715 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pointage ADD id_user_id INT NOT NULL, ADD id_chantier_id INT NOT NULL');
        $this->addSql('ALTER TABLE pointage ADD CONSTRAINT FK_7591B2079F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE pointage ADD CONSTRAINT FK_7591B20C8D2C96A FOREIGN KEY (id_chantier_id) REFERENCES chantier (id)');
        $this->addSql('CREATE INDEX IDX_7591B2079F37AE5 ON pointage (id_user_id)');
        $this->addSql('CREATE INDEX IDX_7591B20C8D2C96A ON pointage (id_chantier_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pointage DROP FOREIGN KEY FK_7591B2079F37AE5');
        $this->addSql('ALTER TABLE pointage DROP FOREIGN KEY FK_7591B20C8D2C96A');
        $this->addSql('DROP INDEX IDX_7591B2079F37AE5 ON pointage');
        $this->addSql('DROP INDEX IDX_7591B20C8D2C96A ON pointage');
        $this->addSql('ALTER TABLE pointage DROP id_user_id, DROP id_chantier_id');
    }
}
