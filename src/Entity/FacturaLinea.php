<?php

namespace App\Entity;

use App\Repository\FacturaLineaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FacturaLineaRepository::class)
 */
class FacturaLinea
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Factura::class, inversedBy="facturaLineas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $factura;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $concepto;

    /**
     * @ORM\Column(type="float")
     */
    private $importeUnitario;

    /**
     * @ORM\Column(type="float")
     */
    private $cuotaIva;

    /**
     * @ORM\Column(type="float")
     */
    private $importeTotal;

    /**
     * @ORM\Column(type="integer")
     */
    private $unidades;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFactura(): ?Factura
    {
        return $this->factura;
    }

    public function setFactura(?Factura $factura): self
    {
        $this->factura = $factura;

        return $this;
    }

    public function getConcepto(): ?string
    {
        return $this->concepto;
    }

    public function setConcepto(string $concepto): self
    {
        $this->concepto = $concepto;

        return $this;
    }

    public function getImporteUnitario(): ?float
    {
        return $this->importeUnitario;
    }

    public function setImporteUnitario(float $importeUnitario): self
    {
        $this->importeUnitario = $importeUnitario;

        return $this;
    }

    public function getCuotaIva(): ?float
    {
        return $this->cuotaIva;
    }

    public function setCuotaIva(float $cuotaIva): self
    {
        $this->cuotaIva = $cuotaIva;

        return $this;
    }

    public function getImporteTotal(): ?float
    {
        return $this->importeTotal;
    }

    public function setImporteTotal(float $importeTotal): self
    {
        $this->importeTotal = $importeTotal;

        return $this;
    }

    public function getUnidades(): ?int
    {
        return $this->unidades;
    }

    public function setUnidades(int $unidades): self
    {
        $this->unidades = $unidades;

        return $this;
    }
}
