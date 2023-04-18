<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230418174747 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE annonces (id INT AUTO_INCREMENT NOT NULL, recruteur_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, job VARCHAR(255) NOT NULL, salary VARCHAR(255) NOT NULL, announcement LONGTEXT NOT NULL, INDEX IDX_CB988C6FBB0859F1 (recruteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE annonces_candidat (annonces_id INT NOT NULL, candidat_id INT NOT NULL, INDEX IDX_6433F9DD4C2885D7 (annonces_id), INDEX IDX_6433F9DD8D0EB82 (candidat_id), PRIMARY KEY(annonces_id, candidat_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE annonces ADD CONSTRAINT FK_CB988C6FBB0859F1 FOREIGN KEY (recruteur_id) REFERENCES annonces (id)');
        $this->addSql('ALTER TABLE annonces_candidat ADD CONSTRAINT FK_6433F9DD4C2885D7 FOREIGN KEY (annonces_id) REFERENCES annonces (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE annonces_candidat ADD CONSTRAINT FK_6433F9DD8D0EB82 FOREIGN KEY (candidat_id) REFERENCES candidat (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annonces DROP FOREIGN KEY FK_CB988C6FBB0859F1');
        $this->addSql('ALTER TABLE annonces_candidat DROP FOREIGN KEY FK_6433F9DD4C2885D7');
        $this->addSql('ALTER TABLE annonces_candidat DROP FOREIGN KEY FK_6433F9DD8D0EB82');
        $this->addSql('DROP TABLE annonces');
        $this->addSql('DROP TABLE annonces_candidat');
    }
}
