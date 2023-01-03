<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230103181627 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `admin` (id INT AUTO_INCREMENT NOT NULL, nom_adm VARCHAR(200) NOT NULL, prenom_adm VARCHAR(200) NOT NULL, email_adm VARCHAR(255) NOT NULL, mdp_adm VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE admin_bien (admin_id INT NOT NULL, bien_id INT NOT NULL, INDEX IDX_65F44166642B8210 (admin_id), INDEX IDX_65F44166BD95B80F (bien_id), PRIMARY KEY(admin_id, bien_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bien (id INT AUTO_INCREMENT NOT NULL, id_cat_id INT NOT NULL, type_bien VARCHAR(1) NOT NULL, titre_bien VARCHAR(255) NOT NULL, surface_bien INT NOT NULL, prix_bien DOUBLE PRECISION NOT NULL, localisation_bien VARCHAR(255) NOT NULL, description_bien LONGTEXT DEFAULT NULL, INDEX IDX_45EDC386C09A1CAE (id_cat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, titre_cat VARCHAR(80) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE favori (id INT AUTO_INCREMENT NOT NULL, email_fav VARCHAR(255) NOT NULL, date_fav DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE favori_bien (favori_id INT NOT NULL, bien_id INT NOT NULL, INDEX IDX_ED575181FF17033F (favori_id), INDEX IDX_ED575181BD95B80F (bien_id), PRIMARY KEY(favori_id, bien_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE admin_bien ADD CONSTRAINT FK_65F44166642B8210 FOREIGN KEY (admin_id) REFERENCES `admin` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE admin_bien ADD CONSTRAINT FK_65F44166BD95B80F FOREIGN KEY (bien_id) REFERENCES bien (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE bien ADD CONSTRAINT FK_45EDC386C09A1CAE FOREIGN KEY (id_cat_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE favori_bien ADD CONSTRAINT FK_ED575181FF17033F FOREIGN KEY (favori_id) REFERENCES favori (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE favori_bien ADD CONSTRAINT FK_ED575181BD95B80F FOREIGN KEY (bien_id) REFERENCES bien (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE admin_bien DROP FOREIGN KEY FK_65F44166642B8210');
        $this->addSql('ALTER TABLE admin_bien DROP FOREIGN KEY FK_65F44166BD95B80F');
        $this->addSql('ALTER TABLE bien DROP FOREIGN KEY FK_45EDC386C09A1CAE');
        $this->addSql('ALTER TABLE favori_bien DROP FOREIGN KEY FK_ED575181FF17033F');
        $this->addSql('ALTER TABLE favori_bien DROP FOREIGN KEY FK_ED575181BD95B80F');
        $this->addSql('DROP TABLE `admin`');
        $this->addSql('DROP TABLE admin_bien');
        $this->addSql('DROP TABLE bien');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE favori');
        $this->addSql('DROP TABLE favori_bien');
    }
}
