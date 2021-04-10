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
     * @ORM\ManyToOne(targetEntity=TipoTratamiento::class, inversedBy="tratamiento")
     */
    private $tipoTratamiento;

    /**
     * @ORM\ManyToOne(targetEntity=Tratamiento::class)
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

    public function getTipoTratamiento(): ?TipoTratamiento
    {
        return $this->tipoTratamiento;
    }

    public function setTipoTratamiento(?TipoTratamiento $tipoTratamiento): self
    {
        $this->tipoTratamiento = $tipoTratamiento;

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
}
