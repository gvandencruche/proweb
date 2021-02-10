<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210208164441 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE images DROP FOREIGN KEY FK_E01FBE6AC7F4A74B');
        $this->addSql('DROP INDEX IDX_E01FBE6AC7F4A74B ON images');
        $this->addSql('ALTER TABLE images DROP medias_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE images ADD medias_id INT NOT NULL');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT FK_E01FBE6AC7F4A74B FOREIGN KEY (medias_id) REFERENCES medias (id)');
        $this->addSql('CREATE INDEX IDX_E01FBE6AC7F4A74B ON images (medias_id)');
    }
}
