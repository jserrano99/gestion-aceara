<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldFacturaLinea
 *
 * @ORM\Table(name="old_factura_linea")
 * @ORM\Entity
 */
class OldFacturaLinea
{
    /**
     * @var int
     *
     * @ORM\Column(name="idLinea", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idlinea;

    /**
     * @var int
     *
     * @ORM\Column(name="idFactura", type="integer", nullable=false)
     */
    private $idfactura;

    /**
     * @var int
     *
     * @ORM\Column(name="idConcepto", type="integer", nullable=false)
     */
    private $idconcepto;

    /**
     * @var int
     *
     * @ORM\Column(name="nmUnidades", type="integer", nullable=false)
     */
    private $nmunidades;

    /**
     * @var string|null
     *
     * @ORM\Column(name="dsTipoTratamiento", type="string", length=255, nullable=true)
     */
    private $dstipotratamiento;

    /**
     * @var float
     *
     * @ORM\Column(name="nmimporteUnitario", type="float", precision=10, scale=0, nullable=false)
     */
    private $nmimporteunitario;

    /**
     * @var float
     *
     * @ORM\Column(name="nmimporteConcepto", type="float", precision=10, scale=0, nullable=false)
     */
    private $nmimporteconcepto;

    /**
     * @var float
     *
     * @ORM\Column(name="nmimporteTotal", type="float", precision=10, scale=0, nullable=false)
     */
    private $nmimportetotal;

    /**
     * @var float
     *
     * @ORM\Column(name="nmcuotaIVA", type="float", precision=10, scale=0, nullable=false)
     */
    private $nmcuotaiva;

    /**
     * @var float
     *
     * @ORM\Column(name="nmIVA", type="float", precision=10, scale=0, nullable=false)
     */
    private $nmiva;

    /**
     * @return int
     */
    public function getIdlinea(): int
    {
        return $this->idlinea;
    }

    /**
     * @param int $idlinea
     */
    public function setIdlinea(int $idlinea): void
    {
        $this->idlinea = $idlinea;
    }

    /**
     * @return int
     */
    public function getIdfactura(): int
    {
        return $this->idfactura;
    }

    /**
     * @param int $idfactura
     */
    public function setIdfactura(int $idfactura): void
    {
        $this->idfactura = $idfactura;
    }

    /**
     * @return int
     */
    public function getIdconcepto(): int
    {
        return $this->idconcepto;
    }

    /**
     * @param int $idconcepto
     */
    public function setIdconcepto(int $idconcepto): void
    {
        $this->idconcepto = $idconcepto;
    }

    /**
     * @return int
     */
    public function getNmunidades(): int
    {
        return $this->nmunidades;
    }

    /**
     * @param int $nmunidades
     */
    public function setNmunidades(int $nmunidades): void
    {
        $this->nmunidades = $nmunidades;
    }

    /**
     * @return string|null
     */
    public function getDstipotratamiento(): ?string
    {
        return $this->dstipotratamiento;
    }

    /**
     * @param string|null $dstipotratamiento
     */
    public function setDstipotratamiento(?string $dstipotratamiento): void
    {
        $this->dstipotratamiento = $dstipotratamiento;
    }

    /**
     * @return float
     */
    public function getNmimporteunitario(): float
    {
        return $this->nmimporteunitario;
    }

    /**
     * @param float $nmimporteunitario
     */
    public function setNmimporteunitario(float $nmimporteunitario): void
    {
        $this->nmimporteunitario = $nmimporteunitario;
    }

    /**
     * @return float
     */
    public function getNmimporteconcepto(): float
    {
        return $this->nmimporteconcepto;
    }

    /**
     * @param float $nmimporteconcepto
     */
    public function setNmimporteconcepto(float $nmimporteconcepto): void
    {
        $this->nmimporteconcepto = $nmimporteconcepto;
    }

    /**
     * @return float
     */
    public function getNmimportetotal(): float
    {
        return $this->nmimportetotal;
    }

    /**
     * @param float $nmimportetotal
     */
    public function setNmimportetotal(float $nmimportetotal): void
    {
        $this->nmimportetotal = $nmimportetotal;
    }

    /**
     * @return float
     */
    public function getNmcuotaiva(): float
    {
        return $this->nmcuotaiva;
    }

    /**
     * @param float $nmcuotaiva
     */
    public function setNmcuotaiva(float $nmcuotaiva): void
    {
        $this->nmcuotaiva = $nmcuotaiva;
    }

    /**
     * @return float
     */
    public function getNmiva(): float
    {
        return $this->nmiva;
    }

    /**
     * @param float $nmiva
     */
    public function setNmiva(float $nmiva): void
    {
        $this->nmiva = $nmiva;
    }


}
