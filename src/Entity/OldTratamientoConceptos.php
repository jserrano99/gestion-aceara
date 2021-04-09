<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldTratamientoConceptos
 *
 * @ORM\Table(name="old_tratamiento_conceptos")
 * @ORM\Entity
 */
class OldTratamientoConceptos
{
    /**
     * @var int
     *
     * @ORM\Column(name="idConcepto", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idconcepto;

    /**
     * @var int|null
     *
     * @ORM\Column(name="idTratamiento", type="integer", nullable=true)
     */
    private $idtratamiento;

    /**
     * @var int|null
     *
     * @ORM\Column(name="nmUnidades", type="integer", nullable=true)
     */
    private $nmunidades;

    /**
     * @var float|null
     *
     * @ORM\Column(name="nmimporteUnitario", type="float", precision=10, scale=0, nullable=true)
     */
    private $nmimporteunitario;

    /**
     * @var float|null
     *
     * @ORM\Column(name="nmimporteConcepto", type="float", precision=10, scale=0, nullable=true)
     */
    private $nmimporteconcepto;

    /**
     * @var float|null
     *
     * @ORM\Column(name="nmIVA", type="float", precision=10, scale=0, nullable=true)
     */
    private $nmiva;

    /**
     * @var float|null
     *
     * @ORM\Column(name="nmcuotaIVA", type="float", precision=10, scale=0, nullable=true)
     */
    private $nmcuotaiva;

    /**
     * @var float|null
     *
     * @ORM\Column(name="nmimporteTotal", type="float", precision=10, scale=0, nullable=true)
     */
    private $nmimportetotal;

    /**
     * @var string|null
     *
     * @ORM\Column(name="dsTipoTratamiento", type="string", length=255, nullable=true)
     */
    private $dstipotratamiento;

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
     * @return int|null
     */
    public function getIdtratamiento(): ?int
    {
        return $this->idtratamiento;
    }

    /**
     * @param int|null $idtratamiento
     */
    public function setIdtratamiento(?int $idtratamiento): void
    {
        $this->idtratamiento = $idtratamiento;
    }

    /**
     * @return int|null
     */
    public function getNmunidades(): ?int
    {
        return $this->nmunidades;
    }

    /**
     * @param int|null $nmunidades
     */
    public function setNmunidades(?int $nmunidades): void
    {
        $this->nmunidades = $nmunidades;
    }

    /**
     * @return float|null
     */
    public function getNmimporteunitario(): ?float
    {
        return $this->nmimporteunitario;
    }

    /**
     * @param float|null $nmimporteunitario
     */
    public function setNmimporteunitario(?float $nmimporteunitario): void
    {
        $this->nmimporteunitario = $nmimporteunitario;
    }

    /**
     * @return float|null
     */
    public function getNmimporteconcepto(): ?float
    {
        return $this->nmimporteconcepto;
    }

    /**
     * @param float|null $nmimporteconcepto
     */
    public function setNmimporteconcepto(?float $nmimporteconcepto): void
    {
        $this->nmimporteconcepto = $nmimporteconcepto;
    }

    /**
     * @return float|null
     */
    public function getNmiva(): ?float
    {
        return $this->nmiva;
    }

    /**
     * @param float|null $nmiva
     */
    public function setNmiva(?float $nmiva): void
    {
        $this->nmiva = $nmiva;
    }

    /**
     * @return float|null
     */
    public function getNmcuotaiva(): ?float
    {
        return $this->nmcuotaiva;
    }

    /**
     * @param float|null $nmcuotaiva
     */
    public function setNmcuotaiva(?float $nmcuotaiva): void
    {
        $this->nmcuotaiva = $nmcuotaiva;
    }

    /**
     * @return float|null
     */
    public function getNmimportetotal(): ?float
    {
        return $this->nmimportetotal;
    }

    /**
     * @param float|null $nmimportetotal
     */
    public function setNmimportetotal(?float $nmimportetotal): void
    {
        $this->nmimportetotal = $nmimportetotal;
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


}
