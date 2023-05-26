<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230502165547 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE inscription_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, approved TINYINT(1) NOT NULL, INDEX IDX_12467973A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE inscription_request ADD CONSTRAINT FK_12467973A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE annonces DROP FOREIGN KEY FK_CB988C6FA76ED395');
        $this->addSql('DROP INDEX IDX_CB988C6FA76ED395 ON annonces');
        $this->addSql('ALTER TABLE annonces DROP user_id');
        $this->addSql('ALTER TABLE candidat CHANGE cv cv LONGBLOB NOT NULL');
        $this->addSql('ALTER TABLE user ADD type TINYINT(1) NOT NULL, ADD valited TINYINT(1) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inscription_request DROP FOREIGN KEY FK_12467973A76ED395');
        $this->addSql('DROP TABLE inscription_request');
        $this->addSql('ALTER TABLE annonces ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE annonces ADD CONSTRAINT FK_CB988C6FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_CB988C6FA76ED395 ON annonces (user_id)');
        $this->addSql('ALTER TABLE candidat CHANGE cv cv VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user DROP type, DROP valited');
    }
}
