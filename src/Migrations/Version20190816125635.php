<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190816125635 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE picture (id INT AUTO_INCREMENT NOT NULL, photo VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE picture_translation (id INT AUTO_INCREMENT NOT NULL, picture_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, body VARCHAR(255) DEFAULT NULL, locale VARCHAR(10) DEFAULT NULL, INDEX IDX_2A21008CEE45BDBF (picture_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE picture_translation ADD CONSTRAINT FK_2A21008CEE45BDBF FOREIGN KEY (picture_id) REFERENCES picture (id)');
        $this->addSql('ALTER TABLE resume_translation ADD resume_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE resume_translation ADD CONSTRAINT FK_56634F09D262AF09 FOREIGN KEY (resume_id) REFERENCES resume (id)');
        $this->addSql('CREATE INDEX IDX_56634F09D262AF09 ON resume_translation (resume_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE picture_translation DROP FOREIGN KEY FK_2A21008CEE45BDBF');
        $this->addSql('DROP TABLE picture');
        $this->addSql('DROP TABLE picture_translation');
        $this->addSql('ALTER TABLE resume_translation DROP FOREIGN KEY FK_56634F09D262AF09');
        $this->addSql('DROP INDEX IDX_56634F09D262AF09 ON resume_translation');
        $this->addSql('ALTER TABLE resume_translation DROP resume_id');
    }
}
