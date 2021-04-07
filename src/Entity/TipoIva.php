<?php

namespace App\Entity;

use App\Repository\TipoIvaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TipoIvaRepository::class)
 */
class TipoIva
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
    private $porcentaje;

    /**
     * @ORM\OneToMany(targetEntity=TipoTratamiento::class, mappedBy="tipoIva")
     */
    private $tipoTratamientos;

    public function __construct()
    {
        $this->tipoTratamientos = new ArrayCollection();
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

    public function getPorcentaje(): ?float
    {
        return $this->porcentaje;
    }

    public function setPorcentaje(float $porcentaje): self
    {
        $this->porcentaje = $porcentaje;

        return $this;
    }

    /**
     * @return Collection|TipoTratamiento[]
     */
    public function getTipoTratamientos(): Collection
    {
        return $this->tipoTratamientos;
    }

    public function addTipoTratamiento(TipoTratamiento $tipoTratamiento): self
    {
        if (!$this->tipoTratamientos->contains($tipoTratamiento)) {
            $this->tipoTratamientos[] = $tipoTratamiento;
            $tipoTratamiento->setTipoIva($this);
        }

        return $this;
    }

    public function removeTipoTratamiento(TipoTratamiento $tipoTratamiento): self
    {
        if ($this->tipoTratamientos->removeElement($tipoTratamiento)) {
            // set the owning side to null (unless already changed)
            if ($tipoTratamiento->getTipoIva() === $this) {
                $tipoTratamiento->setTipoIva(null);
            }
        }

        return $this;
    }
}
