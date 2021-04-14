<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210414094620 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE factura DROP INDEX IDX_F9EBA00944168F7D, ADD UNIQUE INDEX UNIQ_F9EBA00944168F7D (tratamiento_id)');
        $this->addSql('ALTER TABLE factura DROP FOREIGN KEY FK_F9EBA00944168F7D');
        $this->addSql('ALTER TABLE factura DROP FOREIGN KEY FK_F9EBA009DE734E51');
        $this->addSql('ALTER TABLE factura ADD CONSTRAINT FK_F9EBA00944168F7D FOREIGN KEY (tratamiento_id) REFERENCES tratamiento (id)');
        $this->addSql('ALTER TABLE factura ADD CONSTRAINT FK_F9EBA009DE734E51 FOREIGN KEY (cliente_id) REFERENCES cliente (id)');
        $this->addSql('ALTER TABLE factura_linea DROP FOREIGN KEY FK_DAC3517AF04F795F');
        $this->addSql('ALTER TABLE factura_linea ADD CONSTRAINT FK_DAC3517AF04F795F FOREIGN KEY (factura_id) REFERENCES factura (id)');
        $this->addSql('ALTER TABLE tratamiento DROP FOREIGN KEY FK_61A4A07CDE734E51');
        $this->addSql('ALTER TABLE tratamiento ADD CONSTRAINT FK_61A4A07CDE734E51 FOREIGN KEY (cliente_id) REFERENCES cliente (id)');
        $this->addSql('ALTER TABLE tratamiento_concepto DROP FOREIGN KEY FK_86D5317F44168F7D');
        $this->addSql('ALTER TABLE tratamiento_concepto ADD CONSTRAINT FK_86D5317F44168F7D FOREIGN KEY (tratamiento_id) REFERENCES tratamiento (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE factura DROP INDEX UNIQ_F9EBA00944168F7D, ADD INDEX IDX_F9EBA00944168F7D (tratamiento_id)');
        $this->addSql('ALTER TABLE factura DROP FOREIGN KEY FK_F9EBA009DE734E51');
        $this->addSql('ALTER TABLE factura DROP FOREIGN KEY FK_F9EBA00944168F7D');
        $this->addSql('ALTER TABLE factura ADD CONSTRAINT FK_F9EBA009DE734E51 FOREIGN KEY (cliente_id) REFERENCES cliente (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE factura ADD CONSTRAINT FK_F9EBA00944168F7D FOREIGN KEY (tratamiento_id) REFERENCES tratamiento (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE factura_linea DROP FOREIGN KEY FK_DAC3517AF04F795F');
        $this->addSql('ALTER TABLE factura_linea ADD CONSTRAINT FK_DAC3517AF04F795F FOREIGN KEY (factura_id) REFERENCES factura (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tratamiento DROP FOREIGN KEY FK_61A4A07CDE734E51');
        $this->addSql('ALTER TABLE tratamiento ADD CONSTRAINT FK_61A4A07CDE734E51 FOREIGN KEY (cliente_id) REFERENCES cliente (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tratamiento_concepto DROP FOREIGN KEY FK_86D5317F44168F7D');
        $this->addSql('ALTER TABLE tratamiento_concepto ADD CONSTRAINT FK_86D5317F44168F7D FOREIGN KEY (tratamiento_id) REFERENCES tratamiento (id) ON DELETE CASCADE');
    }
}
