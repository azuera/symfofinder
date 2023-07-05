<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230704132548 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE character_sheet DROP FOREIGN KEY FK_79FF76801FA37B51');
        $this->addSql('DROP INDEX IDX_79FF76801FA37B51 ON character_sheet');
        $this->addSql('ALTER TABLE character_sheet CHANGE character_sheet_user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE character_sheet ADD CONSTRAINT FK_79FF7680A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_79FF7680A76ED395 ON character_sheet (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE character_sheet DROP FOREIGN KEY FK_79FF7680A76ED395');
        $this->addSql('DROP INDEX IDX_79FF7680A76ED395 ON character_sheet');
        $this->addSql('ALTER TABLE character_sheet CHANGE user_id character_sheet_user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE character_sheet ADD CONSTRAINT FK_79FF76801FA37B51 FOREIGN KEY (character_sheet_user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_79FF76801FA37B51 ON character_sheet (character_sheet_user_id)');
    }
}
