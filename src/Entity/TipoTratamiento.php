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
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
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
    public function getImporte()
    {
        return $this->importe;
    }

    /**
     * @param mixed $importe
     */
    public function setImporte($importe): void
    {
        $this->importe = $importe;
    }

    /**
     * @return mixed
     */
    public function getTipoIva()
    {
        return $this->tipoIva;
    }

    /**
     * @param mixed $tipoIva
     */
    public function setTipoIva($tipoIva): void
    {
        $this->tipoIva = $tipoIva;
    }


    public function __toString()
    {
        return $this->descripcion;   // TODO: Implement __toString() method.
    }


}
