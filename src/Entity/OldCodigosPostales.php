<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldCodigosPostales
 *
 * @ORM\Table(name="old_codigos_postales")
 * @ORM\Entity
 */
class OldCodigosPostales
{
    /**
     * @var int
     *
     * @ORM\Column(name="idcdpostal", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcdpostal;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cdPostal", type="string", length=5, nullable=true)
     */
    private $cdpostal;

    /**
     * @var int
     *
     * @ORM\Column(name="idProvincia", type="integer", nullable=false)
     */
    private $idprovincia;

    /**
     * @var int
     *
     * @ORM\Column(name="idLocalidad", type="integer", nullable=false)
     */
    private $idlocalidad;

    /**
     * @return int
     */
    public function getIdcdpostal(): int
    {
        return $this->idcdpostal;
    }

    /**
     * @param int $idcdpostal
     */
    public function setIdcdpostal(int $idcdpostal): void
    {
        $this->idcdpostal = $idcdpostal;
    }

    /**
     * @return string|null
     */
    public function getCdpostal(): ?string
    {
        return $this->cdpostal;
    }

    /**
     * @param string|null $cdpostal
     */
    public function setCdpostal(?string $cdpostal): void
    {
        $this->cdpostal = $cdpostal;
    }

    /**
     * @return int
     */
    public function getIdprovincia(): int
    {
        return $this->idprovincia;
    }

    /**
     * @param int $idprovincia
     */
    public function setIdprovincia(int $idprovincia): void
    {
        $this->idprovincia = $idprovincia;
    }

    /**
     * @return int
     */
    public function getIdlocalidad(): int
    {
        return $this->idlocalidad;
    }

    /**
     * @param int $idlocalidad
     */
    public function setIdlocalidad(int $idlocalidad): void
    {
        $this->idlocalidad = $idlocalidad;
    }


}
