<?php

namespace App\Entity;

use App\Repository\TratamientoConceptoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TratamientoConceptoRepository::class)
 */
class TratamientoConcepto
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $unidades;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $descripcion;

    /**
     * @ORM\Column(type="float", nullable=false)
     */
    private $importeUnitario;

    /**
     * @ORM\Column(type="float", nullable=false)
     */
    private $importeConcepto;

    /**
     * @ORM\Column(type="float", nullable=false)
     */
    private $porcentajeIva;

    /**
     * @ORM\Column(type="float", nullable=false)
     */
    private $cuotaIva;

    /**
     * @ORM\Column(type="float", nullable=false)
     */
    private $importeTotal;


    /**
     * @ORM\ManyToOne(targetEntity=Tratamiento::class, inversedBy="conceptos")
     */
    private $tratamiento;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTratamiento(): ?Tratamiento
    {
        return $this->tratamiento;
    }

    public function setTratamiento(?Tratamiento $tratamiento)
    {
        $this->tratamiento = $tratamiento;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @param mixed $descripcion
     */
    public function setDescripcion($descripcion): void
    {
        $this->descripcion = $descripcion;
    }

    /**
     * @return mixed
     */
    public function getImporteUnitario()
    {
        return $this->importeUnitario;
    }

    /**
     * @param mixed $importeUnitario
     */
    public function setImporteUnitario($importeUnitario): void
    {
        $this->importeUnitario = $importeUnitario;
    }

    /**
     * @return mixed
     */
    public function getImporteConcepto()
    {
        return $this->importeConcepto;
    }

    /**
     * @param mixed $importeConcepto
     */
    public function setImporteConcepto($importeConcepto): void
    {
        $this->importeConcepto = $importeConcepto;
    }

    /**
     * @return mixed
     */
    public function getPorcentajeIva()
    {
        return $this->porcentajeIva;
    }

    /**
     * @param mixed $porcentajeIva
     */
    public function setPorcentajeIva($porcentajeIva): void
    {
        $this->porcentajeIva = $porcentajeIva;
    }

    /**
     * @return mixed
     */
    public function getCuotaIva()
    {
        return $this->cuotaIva;
    }

    /**
     * @param mixed $cuotaIva
     */
    public function setCuotaIva($cuotaIva): void
    {
        $this->cuotaIva = $cuotaIva;
    }

    /**
     * @return mixed
     */
    public function getImporteTotal()
    {
        return $this->importeTotal;
    }

    /**
     * @param mixed $importeTotal
     */
    public function setImporteTotal($importeTotal): void
    {
        $this->importeTotal = $importeTotal;
    }
    
    
}
