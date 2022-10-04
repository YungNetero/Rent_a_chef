<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220930101436 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE menu ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE menu ADD CONSTRAINT FK_7D053A93A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_7D053A93A76ED395 ON menu (user_id)');
        $this->addSql('ALTER TABLE user CHANGE firtname firstname VARCHAR(50) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE menu DROP FOREIGN KEY FK_7D053A93A76ED395');
        $this->addSql('DROP INDEX IDX_7D053A93A76ED395 ON menu');
        $this->addSql('ALTER TABLE menu DROP user_id');
        $this->addSql('ALTER TABLE user CHANGE firstname firtname VARCHAR(50) NOT NULL');
    }
}
