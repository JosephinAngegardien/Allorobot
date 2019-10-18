<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191015130140 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE avis (id INT AUTO_INCREMENT NOT NULL, robot_id INT NOT NULL, author_id INT NOT NULL, created_at DATETIME NOT NULL, rating INT NOT NULL, content LONGTEXT NOT NULL, INDEX IDX_8F91ABF0D5AA10AC (robot_id), INDEX IDX_8F91ABF0F675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE robots_carac_tech (robots_id INT NOT NULL, carac_tech_id INT NOT NULL, INDEX IDX_1D45D72538C4F8F6 (robots_id), INDEX IDX_1D45D7258727AC80 (carac_tech_id), PRIMARY KEY(robots_id, carac_tech_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF0D5AA10AC FOREIGN KEY (robot_id) REFERENCES robots (id)');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF0F675F31B FOREIGN KEY (author_id) REFERENCES particulier (id)');
        $this->addSql('ALTER TABLE robots_carac_tech ADD CONSTRAINT FK_1D45D72538C4F8F6 FOREIGN KEY (robots_id) REFERENCES robots (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE robots_carac_tech ADD CONSTRAINT FK_1D45D7258727AC80 FOREIGN KEY (carac_tech_id) REFERENCES carac_tech (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE robots DROP avis');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE avis');
        $this->addSql('DROP TABLE robots_carac_tech');
        $this->addSql('ALTER TABLE robots ADD avis LONGTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci');
    }
}
