<?php

namespace App\Entity;

use App\Repository\LocalidadRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LocalidadRepository::class)
 */
class Localidad
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $descripcion;

    /**
     * @ORM\Column(type="integer")
     */
    private $codigo;

    /**
     * @ORM\ManyToOne(targetEntity=Provincia::class, inversedBy="localidads")
     */
    private $provincia;

    /**
     * @ORM\OneToMany(targetEntity=Cliente::class, mappedBy="localidad")
     */
    private $clientes;

    /**
     * @ORM\OneToMany(targetEntity=CodigoPostal::class, mappedBy="localidad")
     */
    private $codigosPostales;

    public function __construct()
    {
        $this->clientes = new ArrayCollection();
        $this->codigosPostales = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getProvincia(): ?Provincia
    {
        return $this->provincia;
    }

    public function setProvincia(?Provincia $provincia): self
    {
        $this->provincia = $provincia;

        return $this;
    }

    /**
     * @return Collection|Cliente[]
     */
    public function getClientes(): Collection
    {
        return $this->clientes;
    }

    public function addCliente(Cliente $cliente): self
    {
        if (!$this->clientes->contains($cliente)) {
            $this->clientes[] = $cliente;
            $cliente->setLocalidad($this);
        }

        return $this;
    }

    public function removeCliente(Cliente $cliente): self
    {
        if ($this->clientes->removeElement($cliente)) {
            // set the owning side to null (unless already changed)
            if ($cliente->getLocalidad() === $this) {
                $cliente->setLocalidad(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CodigoPostal[]
     */
    public function getCodigosPostales(): Collection
    {
        return $this->codigosPostales;
    }

    public function addCodigosPostale(CodigoPostal $codigosPostale): self
    {
        if (!$this->codigosPostales->contains($codigosPostale)) {
            $this->codigosPostales[] = $codigosPostale;
            $codigosPostale->setLocalidad($this);
        }

        return $this;
    }

    public function removeCodigosPostale(CodigoPostal $codigosPostale): self
    {
        if ($this->codigosPostales->removeElement($codigosPostale)) {
            // set the owning side to null (unless already changed)
            if ($codigosPostale->getLocalidad() === $this) {
                $codigosPostale->setLocalidad(null);
            }
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * @param mixed $codigo
     */
    public function setCodigo($codigo): void
    {
        $this->codigo = $codigo;
    }


}
