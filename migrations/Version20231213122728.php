<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231213122728 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Tables creation';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE answer (id INT AUTO_INCREMENT NOT NULL, question_id_id INT NOT NULL, text VARCHAR(255) NOT NULL, is_correct TINYINT(1) NOT NULL, INDEX IDX_DADD4A254FAF8F53 (question_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, category VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE difficulty (id INT AUTO_INCREMENT NOT NULL, difficulty_level VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE question (id INT AUTO_INCREMENT NOT NULL, category_id_id INT NOT NULL, difficulty_id_id INT NOT NULL, text VARCHAR(255) NOT NULL, INDEX IDX_B6F7494E9777D11E (category_id_id), INDEX IDX_B6F7494E2C205AF3 (difficulty_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A254FAF8F53 FOREIGN KEY (question_id_id) REFERENCES question (id)');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494E9777D11E FOREIGN KEY (category_id_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494E2C205AF3 FOREIGN KEY (difficulty_id_id) REFERENCES difficulty (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE answer DROP FOREIGN KEY FK_DADD4A254FAF8F53');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494E9777D11E');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494E2C205AF3');
        $this->addSql('DROP TABLE answer');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE difficulty');
        $this->addSql('DROP TABLE question');
    }
}
