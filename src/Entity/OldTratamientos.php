<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldTratamientos
 *
 * @ORM\Table(name="old_tratamientos")
 * @ORM\Entity
 */
class OldTratamientos
{
    /**
     * @var int
     *
     * @ORM\Column(name="tratamiento_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $tratamientoId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="tratamiento_idCliente", type="integer", nullable=true)
     */
    private $tratamientoIdcliente;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="tratamiento_fecha", type="date", nullable=true)
     */
    private $tratamientoFecha;

    /**
     * @var string|null
     *
     * @ORM\Column(name="tratamiento_dsMotivo", type="text", length=65535, nullable=true)
     */
    private $tratamientoDsmotivo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="tratamiento_dsTratamiento", type="text", length=65535, nullable=true)
     */
    private $tratamientoDstratamiento;

    /**
     * @var int|null
     *
     * @ORM\Column(name="tratamiento_nmUnidades", type="integer", nullable=true)
     */
    private $tratamientoNmunidades;

    /**
     * @var string|null
     *
     * @ORM\Column(name="tratamiento_nmImporte", type="decimal", precision=10, scale=0, nullable=true)
     */
    private $tratamientoNmimporte;

    /**
     * @return int
     */
    public function getTratamientoId(): int
    {
        return $this->tratamientoId;
    }

    /**
     * @param int $tratamientoId
     */
    public function setTratamientoId(int $tratamientoId): void
    {
        $this->tratamientoId = $tratamientoId;
    }

    /**
     * @return int|null
     */
    public function getTratamientoIdcliente(): ?int
    {
        return $this->tratamientoIdcliente;
    }

    /**
     * @param int|null $tratamientoIdcliente
     */
    public function setTratamientoIdcliente(?int $tratamientoIdcliente): void
    {
        $this->tratamientoIdcliente = $tratamientoIdcliente;
    }

    /**
     * @return \DateTime|null
     */
    public function getTratamientoFecha(): ?\DateTime
    {
        return $this->tratamientoFecha;
    }

    /**
     * @param \DateTime|null $tratamientoFecha
     */
    public function setTratamientoFecha(?\DateTime $tratamientoFecha): void
    {
        $this->tratamientoFecha = $tratamientoFecha;
    }

    /**
     * @return string|null
     */
    public function getTratamientoDsmotivo(): ?string
    {
        return $this->tratamientoDsmotivo;
    }

    /**
     * @param string|null $tratamientoDsmotivo
     */
    public function setTratamientoDsmotivo(?string $tratamientoDsmotivo): void
    {
        $this->tratamientoDsmotivo = $tratamientoDsmotivo;
    }

    /**
     * @return string|null
     */
    public function getTratamientoDstratamiento(): ?string
    {
        return $this->tratamientoDstratamiento;
    }

    /**
     * @param string|null $tratamientoDstratamiento
     */
    public function setTratamientoDstratamiento(?string $tratamientoDstratamiento): void
    {
        $this->tratamientoDstratamiento = $tratamientoDstratamiento;
    }

    /**
     * @return int|null
     */
    public function getTratamientoNmunidades(): ?int
    {
        return $this->tratamientoNmunidades;
    }

    /**
     * @param int|null $tratamientoNmunidades
     */
    public function setTratamientoNmunidades(?int $tratamientoNmunidades): void
    {
        $this->tratamientoNmunidades = $tratamientoNmunidades;
    }

    /**
     * @return string|null
     */
    public function getTratamientoNmimporte(): ?string
    {
        return $this->tratamientoNmimporte;
    }

    /**
     * @param string|null $tratamientoNmimporte
     */
    public function setTratamientoNmimporte(?string $tratamientoNmimporte): void
    {
        $this->tratamientoNmimporte = $tratamientoNmimporte;
    }


}
