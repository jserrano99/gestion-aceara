<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210409160954 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE old_clientes CHANGE cliente_id cliente_id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE old_codigos_postales CHANGE idcdpostal idcdpostal INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE old_factura_linea CHANGE idLinea idLinea INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE old_facturas CHANGE idFactura idFactura INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE old_tratamiento_conceptos CHANGE idConcepto idConcepto INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE old_tratamientos CHANGE tratamiento_id tratamiento_id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE tratamiento ADD cliente_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tratamiento ADD CONSTRAINT FK_61A4A07CDE734E51 FOREIGN KEY (cliente_id) REFERENCES cliente (id)');
        $this->addSql('CREATE INDEX IDX_61A4A07CDE734E51 ON tratamiento (cliente_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE old_clientes CHANGE cliente_id cliente_id INT NOT NULL');
        $this->addSql('ALTER TABLE old_codigos_postales CHANGE idcdpostal idcdpostal INT NOT NULL');
        $this->addSql('ALTER TABLE old_factura_linea CHANGE idLinea idLinea INT NOT NULL');
        $this->addSql('ALTER TABLE old_facturas CHANGE idFactura idFactura INT NOT NULL');
        $this->addSql('ALTER TABLE old_tratamiento_conceptos CHANGE idConcepto idConcepto INT NOT NULL');
        $this->addSql('ALTER TABLE old_tratamientos CHANGE tratamiento_id tratamiento_id INT NOT NULL');
        $this->addSql('ALTER TABLE tratamiento DROP FOREIGN KEY FK_61A4A07CDE734E51');
        $this->addSql('DROP INDEX IDX_61A4A07CDE734E51 ON tratamiento');
        $this->addSql('ALTER TABLE tratamiento DROP cliente_id');
    }
}
