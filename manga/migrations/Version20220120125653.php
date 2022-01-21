<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220120125653 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE magasin DROP manga');
        $this->addSql('ALTER TABLE manga DROP FOREIGN KEY manga_ibfk_1');
        $this->addSql('DROP INDEX id_auteur ON manga');
        $this->addSql('ALTER TABLE manga ADD magasin_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE manga ADD CONSTRAINT FK_765A9E0320096AE3 FOREIGN KEY (magasin_id) REFERENCES magasin (id)');
        $this->addSql('CREATE INDEX IDX_765A9E0320096AE3 ON manga (magasin_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE magasin ADD manga VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE manga DROP FOREIGN KEY FK_765A9E0320096AE3');
        $this->addSql('DROP INDEX IDX_765A9E0320096AE3 ON manga');
        $this->addSql('ALTER TABLE manga DROP magasin_id');
        $this->addSql('ALTER TABLE manga ADD CONSTRAINT manga_ibfk_1 FOREIGN KEY (id_auteur) REFERENCES auteur (id)');
        $this->addSql('CREATE INDEX id_auteur ON manga (id_auteur)');
    }
}
