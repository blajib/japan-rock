<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240110230739 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE holiday ADD roomaji_translate VARCHAR(255) NOT NULL, ADD japan_translate VARCHAR(255) NOT NULL, ADD french_translate VARCHAR(255) NOT NULL, DROP roomaji, DROP japan, DROP french');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE holiday ADD roomaji VARCHAR(255) NOT NULL, ADD japan VARCHAR(255) NOT NULL, ADD french VARCHAR(255) NOT NULL, DROP roomaji_translate, DROP japan_translate, DROP french_translate');
    }
}
