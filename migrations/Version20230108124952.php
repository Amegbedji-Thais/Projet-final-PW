<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230108124952 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE admin_biens (admin_id INT NOT NULL, biens_id INT NOT NULL, INDEX IDX_BFBAFF27642B8210 (admin_id), INDEX IDX_BFBAFF277773350C (biens_id), PRIMARY KEY(admin_id, biens_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE admin_biens ADD CONSTRAINT FK_BFBAFF27642B8210 FOREIGN KEY (admin_id) REFERENCES admin (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE admin_biens ADD CONSTRAINT FK_BFBAFF277773350C FOREIGN KEY (biens_id) REFERENCES biens (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE admin_biens DROP FOREIGN KEY FK_BFBAFF27642B8210');
        $this->addSql('ALTER TABLE admin_biens DROP FOREIGN KEY FK_BFBAFF277773350C');
        $this->addSql('DROP TABLE admin_biens');
    }
}
