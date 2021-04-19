<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210421111541 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tratamiento ADD factura_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tratamiento ADD CONSTRAINT FK_61A4A07CF04F795F FOREIGN KEY (factura_id) REFERENCES factura (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_61A4A07CF04F795F ON tratamiento (factura_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tratamiento DROP FOREIGN KEY FK_61A4A07CF04F795F');
        $this->addSql('DROP INDEX UNIQ_61A4A07CF04F795F ON tratamiento');
        $this->addSql('ALTER TABLE tratamiento DROP factura_id');
    }
}
