<?php

namespace App\Entity;

use App\Repository\FacturaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FacturaRepository::class)
 */
class Factura
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
    private $numero;

    /**
     * @ORM\Column(type="string", length=4, nullable=true)
     */
    private $serie;

    /**
     * @ORM\Column(type="date")
     */
    private $fechaFactura;

    /**
     * @ORM\ManyToOne(targetEntity=Cliente::class, inversedBy="facturas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cliente;

    /**
     * @ORM\ManyToOne(targetEntity=Tratamiento::class, inversedBy="facturas")
     */
    private $tratamiento;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getSerie(): ?string
    {
        return $this->serie;
    }

    public function setSerie(?string $serie): self
    {
        $this->serie = $serie;

        return $this;
    }

    public function getFechaFactura(): ?\DateTimeInterface
    {
        return $this->fechaFactura;
    }

    public function setFechaFactura(\DateTimeInterface $fechaFactura): self
    {
        $this->fechaFactura = $fechaFactura;

        return $this;
    }

    public function getCliente(): ?Cliente
    {
        return $this->cliente;
    }

    public function setCliente(?Cliente $cliente): self
    {
        $this->cliente = $cliente;

        return $this;
    }

    public function getTratamiento(): ?Tratamiento
    {
        return $this->tratamiento;
    }

    public function setTratamiento(?Tratamiento $tratamiento): self
    {
        $this->tratamiento = $tratamiento;

        return $this;
    }
}
