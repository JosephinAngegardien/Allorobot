<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191022161436 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE images (id INT AUTO_INCREMENT NOT NULL, robots_id INT DEFAULT NULL, url VARCHAR(255) NOT NULL, INDEX IDX_E01FBE6A38C4F8F6 (robots_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT FK_E01FBE6A38C4F8F6 FOREIGN KEY (robots_id) REFERENCES robots (id)');
        $this->addSql('ALTER TABLE carac_tech ADD description LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE robots ADD locomotion VARCHAR(50) NOT NULL, DROP image');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE images');
        $this->addSql('ALTER TABLE carac_tech DROP description');
        $this->addSql('ALTER TABLE robots ADD image LONGTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci, DROP locomotion');
    }
}
