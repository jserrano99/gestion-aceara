<?php

namespace App\Entity;

use App\Repository\FacturaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\Column(type="float")
     */
    private $totalConcepto;

    /**
     * @ORM\Column(type="float")
     */
    private $totalCuotaIva;

    /**
     * @ORM\Column(type="float")
     */
    private $totalfactura;

    /**
     * @ORM\OneToMany(targetEntity=FacturaLinea::class, mappedBy="factura")
     */
    private $facturaLineas;

    /**
     * @ORM\ManyToOne(targetEntity=Tratamiento::class, inversedBy="facturas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tratamiento;

    public function __construct()
    {
        $this->facturaLineas = new ArrayCollection();
    }

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

    /**
     * @return Collection|FacturaLinea[]
     */
    public function getFacturaLineas(): Collection
    {
        return $this->facturaLineas;
    }

    public function addFacturaLinea(FacturaLinea $facturaLinea): self
    {
        if (!$this->facturaLineas->contains($facturaLinea)) {
            $this->facturaLineas[] = $facturaLinea;
            $facturaLinea->setFactura($this);
        }

        return $this;
    }

    public function removeFacturaLinea(FacturaLinea $facturaLinea): self
    {
        if ($this->facturaLineas->removeElement($facturaLinea)) {
            // set the owning side to null (unless already changed)
            if ($facturaLinea->getFactura() === $this) {
                $facturaLinea->setFactura(null);
            }
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTotalConcepto()
    {
        return $this->totalConcepto;
    }

    /**
     * @param mixed $totalConcepto
     */
    public function setTotalConcepto($totalConcepto): void
    {
        $this->totalConcepto = $totalConcepto;
    }

    /**
     * @return mixed
     */
    public function getTotalCuotaIva()
    {
        return $this->totalCuotaIva;
    }

    /**
     * @param mixed $totalCuotaIva
     */
    public function setTotalCuotaIva($totalCuotaIva): void
    {
        $this->totalCuotaIva = $totalCuotaIva;
    }

    /**
     * @return mixed
     */
    public function getTotalfactura()
    {
        return $this->totalfactura;
    }

    /**
     * @param mixed $totalfactura
     */
    public function setTotalfactura($totalfactura): void
    {
        $this->totalfactura = $totalfactura;
    }

    public function __toString()
    {
     return $this->serie.'/'.$this->getNumero();   // TODO: Implement __toString() method.
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
