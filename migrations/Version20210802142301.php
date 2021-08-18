<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210802142301 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pupil ADD school_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pupil ADD CONSTRAINT FK_C7DBD2B1C32A47EE FOREIGN KEY (school_id) REFERENCES school (id)');
        $this->addSql('CREATE INDEX IDX_C7DBD2B1C32A47EE ON pupil (school_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pupil DROP FOREIGN KEY FK_C7DBD2B1C32A47EE');
        $this->addSql('DROP INDEX IDX_C7DBD2B1C32A47EE ON pupil');
        $this->addSql('ALTER TABLE pupil DROP school_id');
    }
}
