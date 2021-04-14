<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210414065728 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tratamiento_concepto ADD descripcion VARCHAR(255) NOT NULL, ADD importe_unitario DOUBLE PRECISION NOT NULL, ADD importe_concepto DOUBLE PRECISION NOT NULL, ADD porcentaje_iva DOUBLE PRECISION NOT NULL, ADD cuota_iva DOUBLE PRECISION NOT NULL, ADD importe_total DOUBLE PRECISION NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tratamiento_concepto DROP descripcion, DROP importe_unitario, DROP importe_concepto, DROP porcentaje_iva, DROP cuota_iva, DROP importe_total');
    }
}
