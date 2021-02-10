<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210208142707 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE images (id INT AUTO_INCREMENT NOT NULL, medias_id INT NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, update_at DATETIME NOT NULL, active TINYINT(1) NOT NULL, INDEX IDX_E01FBE6AC7F4A74B (medias_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medias (id INT AUTO_INCREMENT NOT NULL, type_id INT NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, update_at DATETIME NOT NULL, active TINYINT(1) NOT NULL, INDEX IDX_12D2AF81C54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_medias (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, update_at DATETIME NOT NULL, active TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT FK_E01FBE6AC7F4A74B FOREIGN KEY (medias_id) REFERENCES medias (id)');
        $this->addSql('ALTER TABLE medias ADD CONSTRAINT FK_12D2AF81C54C8C93 FOREIGN KEY (type_id) REFERENCES type_medias (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE images DROP FOREIGN KEY FK_E01FBE6AC7F4A74B');
        $this->addSql('ALTER TABLE medias DROP FOREIGN KEY FK_12D2AF81C54C8C93');
        $this->addSql('DROP TABLE images');
        $this->addSql('DROP TABLE medias');
        $this->addSql('DROP TABLE type_medias');
    }
}
