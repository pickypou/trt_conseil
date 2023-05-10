<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230510200006 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inscription_request DROP FOREIGN KEY FK_12467973A76ED395');
        $this->addSql('DROP TABLE inscription_request');
        $this->addSql('ALTER TABLE annonces DROP locality, DROP schedules, DROP is_approved');
        $this->addSql('ALTER TABLE user ADD validated TINYINT(1) NOT NULL, DROP is_approved');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE inscription_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, approved TINYINT(1) NOT NULL, INDEX IDX_12467973A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE inscription_request ADD CONSTRAINT FK_12467973A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE annonces ADD locality VARCHAR(255) NOT NULL, ADD schedules VARCHAR(255) NOT NULL, ADD is_approved TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD is_approved TINYINT(1) DEFAULT NULL, DROP validated');
    }
}
