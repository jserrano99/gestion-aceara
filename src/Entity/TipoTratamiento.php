<?php

namespace App\Entity;

use App\Repository\TipoTratamientoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TipoTratamientoRepository::class)
 */
class TipoTratamiento
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
     * @ORM\Column(type="float")
     */
    private $importe;

    /**
     * @ORM\ManyToOne(targetEntity=TipoIva::class, inversedBy="tipoTratamientos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tipoIva;

    /**
     * @ORM\OneToMany(targetEntity=Tratamiento::class, mappedBy="tipoTratamiento")
     */
    private $tratamientos;

    /**
     * @ORM\OneToMany(targetEntity=TratamientoConcepto::class, mappedBy="tipoTratamiento")
     */
    private $tratamiento;

    public function __construct()
    {
        $this->tratamientos = new ArrayCollection();
        $this->tratamiento = new ArrayCollection();
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

    public function getImporte(): ?float
    {
        return $this->importe;
    }

    public function setImporte(float $importe): self
    {
        $this->importe = $importe;

        return $this;
    }

    public function getTipoIva(): ?TipoIva
    {
        return $this->tipoIva;
    }

    public function setTipoIva(?TipoIva $tipoIva): self
    {
        $this->tipoIva = $tipoIva;

        return $this;
    }

    /**
     * @return Collection|Tratamiento[]
     */
    public function getTratamientos(): Collection
    {
        return $this->tratamientos;
    }

    public function addTratamiento(Tratamiento $tratamiento): self
    {
        if (!$this->tratamientos->contains($tratamiento)) {
            $this->tratamientos[] = $tratamiento;
            $tratamiento->setTipoTratamiento($this);
        }

        return $this;
    }

    public function removeTratamiento(Tratamiento $tratamiento): self
    {
        if ($this->tratamientos->removeElement($tratamiento)) {
            // set the owning side to null (unless already changed)
            if ($tratamiento->getTipoTratamiento() === $this) {
                $tratamiento->setTipoTratamiento(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|TratamientoConcepto[]
     */
    public function getTratamiento(): Collection
    {
        return $this->tratamiento;
    }
}
