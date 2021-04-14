<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210414071555 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tratamiento_concepto DROP FOREIGN KEY FK_86D5317FC8C540DD');
        $this->addSql('DROP INDEX IDX_86D5317FC8C540DD ON tratamiento_concepto');
        $this->addSql('ALTER TABLE tratamiento_concepto DROP tipo_tratamiento_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tratamiento_concepto ADD tipo_tratamiento_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tratamiento_concepto ADD CONSTRAINT FK_86D5317FC8C540DD FOREIGN KEY (tipo_tratamiento_id) REFERENCES tipo_tratamiento (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_86D5317FC8C540DD ON tratamiento_concepto (tipo_tratamiento_id)');
    }
}
