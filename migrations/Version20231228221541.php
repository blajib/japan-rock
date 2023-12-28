<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231228221541 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE word DROP FOREIGN KEY FK_C3F17511DAEA0896');
        $this->addSql(
            'ALTER TABLE word ADD CONSTRAINT FK_C3F17511DAEA0896 FOREIGN KEY (word_group_id) REFERENCES word_group (id)'
        );
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE word DROP FOREIGN KEY FK_C3F17511DAEA0896');
        $this->addSql(
            'ALTER TABLE word ADD CONSTRAINT FK_C3F17511DAEA0896 FOREIGN KEY (word_group_id) REFERENCES word (id) ON UPDATE NO ACTION ON DELETE NO ACTION'
        );
    }
}
