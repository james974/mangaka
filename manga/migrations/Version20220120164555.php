<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220120164555 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE manga_auteur');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE manga_auteur (manga_id INT NOT NULL, auteur_id INT NOT NULL, INDEX IDX_D61A13477B6461 (manga_id), INDEX IDX_D61A134760BB6FE6 (auteur_id), PRIMARY KEY(manga_id, auteur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE manga_auteur ADD CONSTRAINT FK_D61A134760BB6FE6 FOREIGN KEY (auteur_id) REFERENCES auteur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE manga_auteur ADD CONSTRAINT FK_D61A13477B6461 FOREIGN KEY (manga_id) REFERENCES manga (id) ON DELETE CASCADE');
    }
}
