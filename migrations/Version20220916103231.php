<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220916103231 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adress_user (adress_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_222DFD048486F9AC (adress_id), INDEX IDX_222DFD04A76ED395 (user_id), PRIMARY KEY(adress_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE adress_user ADD CONSTRAINT FK_222DFD048486F9AC FOREIGN KEY (adress_id) REFERENCES adress (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE adress_user ADD CONSTRAINT FK_222DFD04A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menu ADD category_id INT NOT NULL');
        $this->addSql('ALTER TABLE menu ADD CONSTRAINT FK_7D053A9312469DE2 FOREIGN KEY (category_id) REFERENCES menu_category (id)');
        $this->addSql('CREATE INDEX IDX_7D053A9312469DE2 ON menu (category_id)');
        $this->addSql('ALTER TABLE menu_img ADD menu_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE menu_img ADD CONSTRAINT FK_2363069ECCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id)');
        $this->addSql('CREATE INDEX IDX_2363069ECCD7E912 ON menu_img (menu_id)');
        $this->addSql('ALTER TABLE message ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_B6BD307FA76ED395 ON message (user_id)');
        $this->addSql('ALTER TABLE rate ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rate ADD CONSTRAINT FK_DFEC3F39A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_DFEC3F39A76ED395 ON rate (user_id)');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adress_user DROP FOREIGN KEY FK_222DFD048486F9AC');
        $this->addSql('ALTER TABLE adress_user DROP FOREIGN KEY FK_222DFD04A76ED395');
        $this->addSql('DROP TABLE adress_user');
        $this->addSql('ALTER TABLE menu DROP FOREIGN KEY FK_7D053A9312469DE2');
        $this->addSql('DROP INDEX IDX_7D053A9312469DE2 ON menu');
        $this->addSql('ALTER TABLE menu DROP category_id');
        $this->addSql('ALTER TABLE menu_img DROP FOREIGN KEY FK_2363069ECCD7E912');
        $this->addSql('DROP INDEX IDX_2363069ECCD7E912 ON menu_img');
        $this->addSql('ALTER TABLE menu_img DROP menu_id');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FA76ED395');
        $this->addSql('DROP INDEX IDX_B6BD307FA76ED395 ON message');
        $this->addSql('ALTER TABLE message DROP user_id');
        $this->addSql('ALTER TABLE rate DROP FOREIGN KEY FK_DFEC3F39A76ED395');
        $this->addSql('DROP INDEX IDX_DFEC3F39A76ED395 ON rate');
        $this->addSql('ALTER TABLE rate DROP user_id');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COLLATE `utf8mb4_bin`');
    }
}
