<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220919103219 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adress_user DROP FOREIGN KEY FK_222DFD048486F9AC');
        $this->addSql('ALTER TABLE adress_user DROP FOREIGN KEY FK_222DFD04A76ED395');
        $this->addSql('DROP TABLE adress_user');
        $this->addSql('ALTER TABLE adress ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE adress ADD CONSTRAINT FK_5CECC7BEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_5CECC7BEA76ED395 ON adress (user_id)');
        $this->addSql('ALTER TABLE message ADD receiver_id INT NOT NULL, DROP message_to, DROP message_from');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FCD53EDB6 FOREIGN KEY (receiver_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_B6BD307FCD53EDB6 ON message (receiver_id)');
        $this->addSql('ALTER TABLE rate ADD receiver_id INT NOT NULL');
        $this->addSql('ALTER TABLE rate ADD CONSTRAINT FK_DFEC3F39CD53EDB6 FOREIGN KEY (receiver_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_DFEC3F39CD53EDB6 ON rate (receiver_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adress_user (adress_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_222DFD048486F9AC (adress_id), INDEX IDX_222DFD04A76ED395 (user_id), PRIMARY KEY(adress_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE adress_user ADD CONSTRAINT FK_222DFD048486F9AC FOREIGN KEY (adress_id) REFERENCES adress (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE adress_user ADD CONSTRAINT FK_222DFD04A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE adress DROP FOREIGN KEY FK_5CECC7BEA76ED395');
        $this->addSql('DROP INDEX IDX_5CECC7BEA76ED395 ON adress');
        $this->addSql('ALTER TABLE adress DROP user_id');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FCD53EDB6');
        $this->addSql('DROP INDEX IDX_B6BD307FCD53EDB6 ON message');
        $this->addSql('ALTER TABLE message ADD message_to VARCHAR(50) NOT NULL, ADD message_from VARCHAR(50) NOT NULL, DROP receiver_id');
        $this->addSql('ALTER TABLE rate DROP FOREIGN KEY FK_DFEC3F39CD53EDB6');
        $this->addSql('DROP INDEX IDX_DFEC3F39CD53EDB6 ON rate');
        $this->addSql('ALTER TABLE rate DROP receiver_id');
    }
}
