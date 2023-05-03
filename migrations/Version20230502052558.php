<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230502052558 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE annonces (id INT AUTO_INCREMENT NOT NULL, recruteur_id INT DEFAULT NULL, job VARCHAR(255) NOT NULL, salairy VARCHAR(255) NOT NULL, annonce LONGTEXT NOT NULL, INDEX IDX_CB988C6FBB0859F1 (recruteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE candidat (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, cv VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_6AB5B471A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recruteur (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, companyname VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, siteweb VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, UNIQUE INDEX UNIQ_2BD3678CA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE annonces ADD CONSTRAINT FK_CB988C6FBB0859F1 FOREIGN KEY (recruteur_id) REFERENCES recruteur (id)');
        $this->addSql('ALTER TABLE candidat ADD CONSTRAINT FK_6AB5B471A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE recruteur ADD CONSTRAINT FK_2BD3678CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE candidats DROP FOREIGN KEY FK_3C663B15A76ED395');
        $this->addSql('DROP TABLE annonce');
        $this->addSql('DROP TABLE candidats');
        $this->addSql('DROP TABLE recruteurs');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE annonce (id INT AUTO_INCREMENT NOT NULL, poste VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, workplace VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, shedule VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, salary VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE candidats (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, cv VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, create_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', update_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_3C663B15A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE recruteurs (id INT AUTO_INCREMENT NOT NULL, company_name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, address VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE candidats ADD CONSTRAINT FK_3C663B15A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE annonces DROP FOREIGN KEY FK_CB988C6FBB0859F1');
        $this->addSql('ALTER TABLE candidat DROP FOREIGN KEY FK_6AB5B471A76ED395');
        $this->addSql('ALTER TABLE recruteur DROP FOREIGN KEY FK_2BD3678CA76ED395');
        $this->addSql('DROP TABLE annonces');
        $this->addSql('DROP TABLE candidat');
        $this->addSql('DROP TABLE recruteur');
    }
}
