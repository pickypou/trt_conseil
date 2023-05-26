<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230510195424 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE candidacy DROP FOREIGN KEY FK_D930569D8805AB2F');
        $this->addSql('ALTER TABLE candidacy DROP FOREIGN KEY FK_D930569DA76ED395');
        $this->addSql('DROP TABLE candidacy');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE candidacy (id INT AUTO_INCREMENT NOT NULL, annonce_id INT DEFAULT NULL, user_id INT DEFAULT NULL, INDEX IDX_D930569D8805AB2F (annonce_id), INDEX IDX_D930569DA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE candidacy ADD CONSTRAINT FK_D930569D8805AB2F FOREIGN KEY (annonce_id) REFERENCES annonces (id)');
        $this->addSql('ALTER TABLE candidacy ADD CONSTRAINT FK_D930569DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }
}
