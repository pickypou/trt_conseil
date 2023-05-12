<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230512135306 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annonces DROP is_approved, DROP locality, DROP schedules');
        $this->addSql('ALTER TABLE candidacy DROP is_approved');
        $this->addSql('ALTER TABLE user ADD validated TINYINT(1) NOT NULL, DROP is_approved');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annonces ADD is_approved TINYINT(1) DEFAULT NULL, ADD locality VARCHAR(255) NOT NULL, ADD schedules VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE candidacy ADD is_approved TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD is_approved TINYINT(1) DEFAULT NULL, DROP validated');
    }
}
