<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldFacturas
 *
 * @ORM\Table(name="old_facturas")
 * @ORM\Entity
 */
class OldFacturas
{
    /**
     * @var int
     *
     * @ORM\Column(name="idFactura", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idfactura;

    /**
     * @var string|null
     *
     * @ORM\Column(name="serie", type="string", length=4, nullable=true)
     */
    private $serie;

    /**
     * @var int|null
     *
     * @ORM\Column(name="nmFactura", type="integer", nullable=true)
     */
    private $nmfactura;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fcFactura", type="date", nullable=true)
     */
    private $fcfactura;

    /**
     * @var int|null
     *
     * @ORM\Column(name="idCliente", type="integer", nullable=true)
     */
    private $idcliente;

    /**
     * @var int
     *
     * @ORM\Column(name="idTratamiento", type="integer", nullable=false)
     */
    private $idtratamiento;

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
     * @return string|null
     */
    public function getSerie(): ?string
    {
        return $this->serie;
    }

    /**
     * @param string|null $serie
     */
    public function setSerie(?string $serie): void
    {
        $this->serie = $serie;
    }

    /**
     * @return int|null
     */
    public function getNmfactura(): ?int
    {
        return $this->nmfactura;
    }

    /**
     * @param int|null $nmfactura
     */
    public function setNmfactura(?int $nmfactura): void
    {
        $this->nmfactura = $nmfactura;
    }

    /**
     * @return \DateTime|null
     */
    public function getFcfactura(): ?\DateTime
    {
        return $this->fcfactura;
    }

    /**
     * @param \DateTime|null $fcfactura
     */
    public function setFcfactura(?\DateTime $fcfactura): void
    {
        $this->fcfactura = $fcfactura;
    }

    /**
     * @return int|null
     */
    public function getIdcliente(): ?int
    {
        return $this->idcliente;
    }

    /**
     * @param int|null $idcliente
     */
    public function setIdcliente(?int $idcliente): void
    {
        $this->idcliente = $idcliente;
    }

    /**
     * @return int
     */
    public function getIdtratamiento(): int
    {
        return $this->idtratamiento;
    }

    /**
     * @param int $idtratamiento
     */
    public function setIdtratamiento(int $idtratamiento): void
    {
        $this->idtratamiento = $idtratamiento;
    }



}
