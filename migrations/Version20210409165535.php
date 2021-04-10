<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210409165535 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE factura_linea (id INT AUTO_INCREMENT NOT NULL, factura_id INT NOT NULL, concepto VARCHAR(255) NOT NULL, importe_unitario DOUBLE PRECISION NOT NULL, cuota_iva DOUBLE PRECISION NOT NULL, importe_total DOUBLE PRECISION NOT NULL, unidades INT NOT NULL, INDEX IDX_DAC3517AF04F795F (factura_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE factura_linea ADD CONSTRAINT FK_DAC3517AF04F795F FOREIGN KEY (factura_id) REFERENCES factura (id)');
        $this->addSql('ALTER TABLE tratamiento_concepto DROP FOREIGN KEY FK_86D5317F44168F7D');
        $this->addSql('ALTER TABLE tratamiento_concepto ADD CONSTRAINT FK_86D5317F44168F7D FOREIGN KEY (tratamiento_id) REFERENCES tratamiento (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE factura_linea');
        $this->addSql('ALTER TABLE tratamiento_concepto DROP FOREIGN KEY FK_86D5317F44168F7D');
        $this->addSql('ALTER TABLE tratamiento_concepto ADD CONSTRAINT FK_86D5317F44168F7D FOREIGN KEY (tratamiento_id) REFERENCES tratamiento (id) ON DELETE CASCADE');
    }
}
