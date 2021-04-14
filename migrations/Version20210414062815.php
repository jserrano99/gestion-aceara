<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210414062815 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UX_OLDCLIENTE ON cliente');
        $this->addSql('ALTER TABLE factura DROP FOREIGN KEY FK_F9EBA00944168F7D');
        $this->addSql('ALTER TABLE factura DROP FOREIGN KEY FK_F9EBA009DE734E51');
        $this->addSql('ALTER TABLE factura ADD CONSTRAINT FK_F9EBA00944168F7D FOREIGN KEY (tratamiento_id) REFERENCES tratamiento (id)');
        $this->addSql('ALTER TABLE factura ADD CONSTRAINT FK_F9EBA009DE734E51 FOREIGN KEY (cliente_id) REFERENCES cliente (id)');
        $this->addSql('ALTER TABLE factura_linea DROP FOREIGN KEY FK_DAC3517AF04F795F');
        $this->addSql('ALTER TABLE factura_linea ADD CONSTRAINT FK_DAC3517AF04F795F FOREIGN KEY (factura_id) REFERENCES factura (id)');
        $this->addSql('ALTER TABLE old_clientes CHANGE migrado migrado INT NOT NULL');
        $this->addSql('DROP INDEX idTratamiento ON old_tratamiento_conceptos');
        $this->addSql('DROP INDEX idTratamiento_2 ON old_tratamiento_conceptos');
        $this->addSql('DROP INDEX idTratamiento_3 ON old_tratamiento_conceptos');
        $this->addSql('ALTER TABLE old_tratamientos CHANGE tratamiento_id tratamiento_id INT AUTO_INCREMENT NOT NULL, CHANGE tratamiento_fecha tratamiento_fecha DATE DEFAULT NULL, CHANGE tratamiento_dsMotivo tratamiento_dsMotivo TEXT DEFAULT NULL, CHANGE tratamiento_dsTratamiento tratamiento_dsTratamiento TEXT DEFAULT NULL, CHANGE tratamiento_nmImporte tratamiento_nmImporte NUMERIC(10, 0) DEFAULT NULL, ADD PRIMARY KEY (tratamiento_id)');
        $this->addSql('ALTER TABLE tratamiento DROP FOREIGN KEY FK_61A4A07CC8C540DD');
        $this->addSql('ALTER TABLE tratamiento DROP FOREIGN KEY FK_61A4A07CDE734E51');
        $this->addSql('DROP INDEX IDX_61A4A07CC8C540DD ON tratamiento');
        $this->addSql('ALTER TABLE tratamiento DROP tipo_tratamiento_id, DROP unidades, DROP importe');
        $this->addSql('ALTER TABLE tratamiento ADD CONSTRAINT FK_61A4A07CDE734E51 FOREIGN KEY (cliente_id) REFERENCES cliente (id)');
        $this->addSql('ALTER TABLE tratamiento_concepto DROP FOREIGN KEY FK_86D5317F44168F7D');
        $this->addSql('ALTER TABLE tratamiento_concepto ADD CONSTRAINT FK_86D5317F44168F7D FOREIGN KEY (tratamiento_id) REFERENCES tratamiento (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE UNIQUE INDEX UX_OLDCLIENTE ON cliente (id_anterior)');
        $this->addSql('ALTER TABLE factura DROP FOREIGN KEY FK_F9EBA009DE734E51');
        $this->addSql('ALTER TABLE factura DROP FOREIGN KEY FK_F9EBA00944168F7D');
        $this->addSql('ALTER TABLE factura ADD CONSTRAINT FK_F9EBA009DE734E51 FOREIGN KEY (cliente_id) REFERENCES cliente (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE factura ADD CONSTRAINT FK_F9EBA00944168F7D FOREIGN KEY (tratamiento_id) REFERENCES tratamiento (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE factura_linea DROP FOREIGN KEY FK_DAC3517AF04F795F');
        $this->addSql('ALTER TABLE factura_linea ADD CONSTRAINT FK_DAC3517AF04F795F FOREIGN KEY (factura_id) REFERENCES factura (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE old_clientes CHANGE migrado migrado INT DEFAULT 0 NOT NULL');
        $this->addSql('CREATE INDEX idTratamiento ON old_tratamiento_conceptos (idTratamiento)');
        $this->addSql('CREATE INDEX idTratamiento_2 ON old_tratamiento_conceptos (idTratamiento)');
        $this->addSql('CREATE INDEX idTratamiento_3 ON old_tratamiento_conceptos (idTratamiento)');
        $this->addSql('ALTER TABLE old_tratamientos MODIFY tratamiento_id INT NOT NULL');
        $this->addSql('ALTER TABLE old_tratamientos DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE old_tratamientos CHANGE tratamiento_id tratamiento_id INT DEFAULT NULL, CHANGE tratamiento_fecha tratamiento_fecha VARCHAR(10) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, CHANGE tratamiento_dsMotivo tratamiento_dsMotivo VARCHAR(237) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, CHANGE tratamiento_dsTratamiento tratamiento_dsTratamiento VARCHAR(1134) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, CHANGE tratamiento_nmImporte tratamiento_nmImporte INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tratamiento DROP FOREIGN KEY FK_61A4A07CDE734E51');
        $this->addSql('ALTER TABLE tratamiento ADD tipo_tratamiento_id INT DEFAULT NULL, ADD unidades INT DEFAULT NULL, ADD importe DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE tratamiento ADD CONSTRAINT FK_61A4A07CC8C540DD FOREIGN KEY (tipo_tratamiento_id) REFERENCES tipo_tratamiento (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE tratamiento ADD CONSTRAINT FK_61A4A07CDE734E51 FOREIGN KEY (cliente_id) REFERENCES cliente (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_61A4A07CC8C540DD ON tratamiento (tipo_tratamiento_id)');
        $this->addSql('ALTER TABLE tratamiento_concepto DROP FOREIGN KEY FK_86D5317F44168F7D');
        $this->addSql('ALTER TABLE tratamiento_concepto ADD CONSTRAINT FK_86D5317F44168F7D FOREIGN KEY (tratamiento_id) REFERENCES tratamiento (id) ON DELETE CASCADE');
    }
}
