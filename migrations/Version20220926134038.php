<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220926134038 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE menu CHANGE description description VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user ADD firtname VARCHAR(50) NOT NULL, ADD lastnamr VARCHAR(50) NOT NULL, DROP lastname, DROP firstname, DROP company, DROP role, DROP phone, DROP created_at, DROP updated_at, DROP is_verifies, DROP avatar');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE menu CHANGE description description VARCHAR(350) NOT NULL');
        $this->addSql('ALTER TABLE user ADD lastname VARCHAR(50) NOT NULL, ADD firstname VARCHAR(50) NOT NULL, ADD company VARCHAR(255) NOT NULL, ADD role VARCHAR(50) NOT NULL, ADD phone VARCHAR(20) NOT NULL, ADD created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD is_verifies TINYINT(1) NOT NULL, ADD avatar VARCHAR(45) NOT NULL, DROP firtname, DROP lastnamr');
    }
}
