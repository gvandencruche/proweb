<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210209094708 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE parametre ADD adresse VARCHAR(255) DEFAULT NULL, ADD footerfacebook VARCHAR(255) DEFAULT NULL, ADD footer_twitter VARCHAR(255) DEFAULT NULL, ADD footer_linkedin VARCHAR(255) DEFAULT NULL, ADD footer_titre VARCHAR(255) DEFAULT NULL, ADD footer_text LONGTEXT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE parametre DROP adresse, DROP footerfacebook, DROP footer_twitter, DROP footer_linkedin, DROP footer_titre, DROP footer_text');
    }
}
