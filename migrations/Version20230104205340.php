<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230104205340 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `admin` (id INT AUTO_INCREMENT NOT NULL, nom_adm VARCHAR(255) NOT NULL, prenom_adm VARCHAR(255) NOT NULL, email_adm VARCHAR(255) NOT NULL, mdp_adm VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE biens (id INT AUTO_INCREMENT NOT NULL, categorie_id INT NOT NULL, type_bien VARCHAR(255) NOT NULL, titre_bien VARCHAR(255) NOT NULL, surface_bien VARCHAR(255) NOT NULL, prix_bien INT NOT NULL, localisation_bien VARCHAR(255) NOT NULL, description_bien VARCHAR(255) NOT NULL, INDEX IDX_1F9004DDBCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE favoris (id INT AUTO_INCREMENT NOT NULL, bien_id INT NOT NULL, mail_fav VARCHAR(255) NOT NULL, INDEX IDX_8933C432BD95B80F (bien_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE biens ADD CONSTRAINT FK_1F9004DDBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categories (id)');
        $this->addSql('ALTER TABLE favoris ADD CONSTRAINT FK_8933C432BD95B80F FOREIGN KEY (bien_id) REFERENCES biens (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE biens DROP FOREIGN KEY FK_1F9004DDBCF5E72D');
        $this->addSql('ALTER TABLE favoris DROP FOREIGN KEY FK_8933C432BD95B80F');
        $this->addSql('DROP TABLE `admin`');
        $this->addSql('DROP TABLE biens');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE favoris');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
