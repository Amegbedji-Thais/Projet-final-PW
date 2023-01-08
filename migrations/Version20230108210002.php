<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230108210002 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE favoris_biens DROP FOREIGN KEY FK_CCF577BC51E8871B');
        $this->addSql('ALTER TABLE favoris_biens DROP FOREIGN KEY FK_CCF577BC7773350C');
        $this->addSql('DROP TABLE favoris_biens');
        $this->addSql('ALTER TABLE favoris ADD bien_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE favoris ADD CONSTRAINT FK_8933C432BD95B80F FOREIGN KEY (bien_id) REFERENCES biens (id)');
        $this->addSql('CREATE INDEX IDX_8933C432BD95B80F ON favoris (bien_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE favoris_biens (favoris_id INT NOT NULL, biens_id INT NOT NULL, INDEX IDX_CCF577BC7773350C (biens_id), INDEX IDX_CCF577BC51E8871B (favoris_id), PRIMARY KEY(favoris_id, biens_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE favoris_biens ADD CONSTRAINT FK_CCF577BC51E8871B FOREIGN KEY (favoris_id) REFERENCES favoris (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE favoris_biens ADD CONSTRAINT FK_CCF577BC7773350C FOREIGN KEY (biens_id) REFERENCES biens (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE favoris DROP FOREIGN KEY FK_8933C432BD95B80F');
        $this->addSql('DROP INDEX IDX_8933C432BD95B80F ON favoris');
        $this->addSql('ALTER TABLE favoris DROP bien_id');
    }
}
