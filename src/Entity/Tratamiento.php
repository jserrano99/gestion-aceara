<?php

namespace App\Entity;

use App\Repository\TratamientoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TratamientoRepository::class)
 */
class Tratamiento
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $fechaTratamiento;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $motivoConsulta;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descripcion;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $unidades;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $importe;

    /**
     * @ORM\ManyToOne(targetEntity=TipoTratamiento::class, inversedBy="tratamientos")
     */
    private $tipoTratamiento;

    /**
     * @ORM\OneToMany(targetEntity=Factura::class, mappedBy="tratamiento")
     */
    private $facturas;

    /**
     * @ORM\ManyToOne(targetEntity=Cliente::class, inversedBy="tratamientos")
     */
    private $cliente;

    public function __construct()
    {
        $this->facturas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFechaTratamiento(): ?\DateTimeInterface
    {
        return $this->fechaTratamiento;
    }

    public function setFechaTratamiento(\DateTimeInterface $fechaTratamiento): self
    {
        $this->fechaTratamiento = $fechaTratamiento;

        return $this;
    }

    public function getMotivoConsulta(): ?string
    {
        return $this->motivoConsulta;
    }

    public function setMotivoConsulta(?string $motivoConsulta): self
    {
        $this->motivoConsulta = $motivoConsulta;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getUnidades(): ?int
    {
        return $this->unidades;
    }

    public function setUnidades(?int $unidades): self
    {
        $this->unidades = $unidades;

        return $this;
    }

    public function getImporte(): ?float
    {
        return $this->importe;
    }

    public function setImporte(?float $importe): self
    {
        $this->importe = $importe;

        return $this;
    }

    public function getTipoTratamiento(): ?TipoTratamiento
    {
        return $this->tipoTratamiento;
    }

    public function setTipoTratamiento(?TipoTratamiento $tipoTratamiento): self
    {
        $this->tipoTratamiento = $tipoTratamiento;

        return $this;
    }

    /**
     * @return Collection|Factura[]
     */
    public function getFacturas(): Collection
    {
        return $this->facturas;
    }

    public function addFactura(Factura $factura): self
    {
        if (!$this->facturas->contains($factura)) {
            $this->facturas[] = $factura;
            $factura->setTratamiento($this);
        }

        return $this;
    }

    public function removeFactura(Factura $factura): self
    {
        if ($this->facturas->removeElement($factura)) {
            // set the owning side to null (unless already changed)
            if ($factura->getTratamiento() === $this) {
                $factura->setTratamiento(null);
            }
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCliente() :?Cliente
    {
        return $this->cliente;
    }


    public function setCliente(?Cliente $cliente)
    {
        $this->cliente = $cliente;
    }


}
