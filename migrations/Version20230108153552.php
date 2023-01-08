<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230108153552 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE admin (id INT AUTO_INCREMENT NOT NULL, nom_adm VARCHAR(255) NOT NULL, prenom_adm VARCHAR(255) NOT NULL, email_adm VARCHAR(255) NOT NULL, mdp_adm VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_880E0D76D02EB05 (email_adm), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE admin_biens (admin_id INT NOT NULL, biens_id INT NOT NULL, INDEX IDX_BFBAFF27642B8210 (admin_id), INDEX IDX_BFBAFF277773350C (biens_id), PRIMARY KEY(admin_id, biens_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE biens (id INT AUTO_INCREMENT NOT NULL, categorie_id INT NOT NULL, type_bien VARCHAR(255) NOT NULL, titre_bien VARCHAR(255) NOT NULL, surface_bien VARCHAR(255) NOT NULL, prix_bien INT NOT NULL, localisation_bien VARCHAR(255) NOT NULL, description_bien LONGTEXT NOT NULL, image VARCHAR(255) NOT NULL, desc_bien LONGTEXT NOT NULL, INDEX IDX_1F9004DDBCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, titre_cat VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE favoris (id INT AUTO_INCREMENT NOT NULL, mail_fav VARCHAR(255) NOT NULL, send TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE favoris_biens (favoris_id INT NOT NULL, biens_id INT NOT NULL, INDEX IDX_CCF577BC51E8871B (favoris_id), INDEX IDX_CCF577BC7773350C (biens_id), PRIMARY KEY(favoris_id, biens_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE admin_biens ADD CONSTRAINT FK_BFBAFF27642B8210 FOREIGN KEY (admin_id) REFERENCES admin (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE admin_biens ADD CONSTRAINT FK_BFBAFF277773350C FOREIGN KEY (biens_id) REFERENCES biens (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE biens ADD CONSTRAINT FK_1F9004DDBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categories (id)');
        $this->addSql('ALTER TABLE favoris_biens ADD CONSTRAINT FK_CCF577BC51E8871B FOREIGN KEY (favoris_id) REFERENCES favoris (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE favoris_biens ADD CONSTRAINT FK_CCF577BC7773350C FOREIGN KEY (biens_id) REFERENCES biens (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE admin_biens DROP FOREIGN KEY FK_BFBAFF27642B8210');
        $this->addSql('ALTER TABLE admin_biens DROP FOREIGN KEY FK_BFBAFF277773350C');
        $this->addSql('ALTER TABLE biens DROP FOREIGN KEY FK_1F9004DDBCF5E72D');
        $this->addSql('ALTER TABLE favoris_biens DROP FOREIGN KEY FK_CCF577BC51E8871B');
        $this->addSql('ALTER TABLE favoris_biens DROP FOREIGN KEY FK_CCF577BC7773350C');
        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP TABLE admin_biens');
        $this->addSql('DROP TABLE biens');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE favoris');
        $this->addSql('DROP TABLE favoris_biens');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
