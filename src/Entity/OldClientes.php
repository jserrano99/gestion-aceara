<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldClientes
 *
 * @ORM\Table(name="old_clientes")
 * @ORM\Entity
 */
class OldClientes
{
    /**
     * @var int
     *
     * @ORM\Column(name="cliente_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $clienteId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cliente_ds", type="string", length=255, nullable=true)
     */
    private $clienteDs;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cliente_dsNombre", type="string", length=50, nullable=true)
     */
    private $clienteDsnombre;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cliente_dsApellido1", type="string", length=50, nullable=true)
     */
    private $clienteDsapellido1;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cliente_dsApellido2", type="string", length=50, nullable=true)
     */
    private $clienteDsapellido2;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cliente_dsDomicilio", type="string", length=255, nullable=true)
     */
    private $clienteDsdomicilio;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cliente_cdPostal", type="string", length=5, nullable=true)
     */
    private $clienteCdpostal;

    /**
     * @var int|null
     *
     * @ORM\Column(name="cliente_idProvincia", type="integer", nullable=true)
     */
    private $clienteIdprovincia;

    /**
     * @var int|null
     *
     * @ORM\Column(name="cliente_idLocalidad", type="integer", nullable=true)
     */
    private $clienteIdlocalidad;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="cliente_fcNacimiento", type="date", nullable=true)
     */
    private $clienteFcnacimiento;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cliente_dsProfesion", type="string", length=255, nullable=true)
     */
    private $clienteDsprofesion;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cliente_dsComentarios", type="text", length=65535, nullable=true)
     */
    private $clienteDscomentarios;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cliente_dsTelefono", type="string", length=9, nullable=true)
     */
    private $clienteDstelefono;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cliente_dsMovil", type="string", length=9, nullable=true)
     */
    private $clienteDsmovil;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cliente_eMail", type="string", length=255, nullable=true)
     */
    private $clienteEmail;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="cliente_fcAlta", type="date", nullable=true)
     */
    private $clienteFcalta;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cliente_NIF", type="string", length=10, nullable=true)
     */
    private $clienteNif;

    /**
     * @return int
     */
    public function getClienteId(): int
    {
        return $this->clienteId;
    }

    /**
     * @param int $clienteId
     */
    public function setClienteId(int $clienteId): void
    {
        $this->clienteId = $clienteId;
    }

    /**
     * @return string|null
     */
    public function getClienteDs(): ?string
    {
        return $this->clienteDs;
    }

    /**
     * @param string|null $clienteDs
     */
    public function setClienteDs(?string $clienteDs): void
    {
        $this->clienteDs = $clienteDs;
    }

    /**
     * @return string|null
     */
    public function getClienteDsnombre(): ?string
    {
        return $this->clienteDsnombre;
    }

    /**
     * @param string|null $clienteDsnombre
     */
    public function setClienteDsnombre(?string $clienteDsnombre): void
    {
        $this->clienteDsnombre = $clienteDsnombre;
    }

    /**
     * @return string|null
     */
    public function getClienteDsapellido1(): ?string
    {
        return $this->clienteDsapellido1;
    }

    /**
     * @param string|null $clienteDsapellido1
     */
    public function setClienteDsapellido1(?string $clienteDsapellido1): void
    {
        $this->clienteDsapellido1 = $clienteDsapellido1;
    }

    /**
     * @return string|null
     */
    public function getClienteDsapellido2(): ?string
    {
        return $this->clienteDsapellido2;
    }

    /**
     * @param string|null $clienteDsapellido2
     */
    public function setClienteDsapellido2(?string $clienteDsapellido2): void
    {
        $this->clienteDsapellido2 = $clienteDsapellido2;
    }

    /**
     * @return string|null
     */
    public function getClienteDsdomicilio(): ?string
    {
        return $this->clienteDsdomicilio;
    }

    /**
     * @param string|null $clienteDsdomicilio
     */
    public function setClienteDsdomicilio(?string $clienteDsdomicilio): void
    {
        $this->clienteDsdomicilio = $clienteDsdomicilio;
    }

    /**
     * @return string|null
     */
    public function getClienteCdpostal(): ?string
    {
        return $this->clienteCdpostal;
    }

    /**
     * @param string|null $clienteCdpostal
     */
    public function setClienteCdpostal(?string $clienteCdpostal): void
    {
        $this->clienteCdpostal = $clienteCdpostal;
    }

    /**
     * @return int|null
     */
    public function getClienteIdprovincia(): ?int
    {
        return $this->clienteIdprovincia;
    }

    /**
     * @param int|null $clienteIdprovincia
     */
    public function setClienteIdprovincia(?int $clienteIdprovincia): void
    {
        $this->clienteIdprovincia = $clienteIdprovincia;
    }

    /**
     * @return int|null
     */
    public function getClienteIdlocalidad(): ?int
    {
        return $this->clienteIdlocalidad;
    }

    /**
     * @param int|null $clienteIdlocalidad
     */
    public function setClienteIdlocalidad(?int $clienteIdlocalidad): void
    {
        $this->clienteIdlocalidad = $clienteIdlocalidad;
    }

    /**
     * @return \DateTime|null
     */
    public function getClienteFcnacimiento(): ?\DateTime
    {
        return $this->clienteFcnacimiento;
    }

    /**
     * @param \DateTime|null $clienteFcnacimiento
     */
    public function setClienteFcnacimiento(?\DateTime $clienteFcnacimiento): void
    {
        $this->clienteFcnacimiento = $clienteFcnacimiento;
    }

    /**
     * @return string|null
     */
    public function getClienteDsprofesion(): ?string
    {
        return $this->clienteDsprofesion;
    }

    /**
     * @param string|null $clienteDsprofesion
     */
    public function setClienteDsprofesion(?string $clienteDsprofesion): void
    {
        $this->clienteDsprofesion = $clienteDsprofesion;
    }

    /**
     * @return string|null
     */
    public function getClienteDscomentarios(): ?string
    {
        return $this->clienteDscomentarios;
    }

    /**
     * @param string|null $clienteDscomentarios
     */
    public function setClienteDscomentarios(?string $clienteDscomentarios): void
    {
        $this->clienteDscomentarios = $clienteDscomentarios;
    }

    /**
     * @return string|null
     */
    public function getClienteDstelefono(): ?string
    {
        return $this->clienteDstelefono;
    }

    /**
     * @param string|null $clienteDstelefono
     */
    public function setClienteDstelefono(?string $clienteDstelefono): void
    {
        $this->clienteDstelefono = $clienteDstelefono;
    }

    /**
     * @return string|null
     */
    public function getClienteDsmovil(): ?string
    {
        return $this->clienteDsmovil;
    }

    /**
     * @param string|null $clienteDsmovil
     */
    public function setClienteDsmovil(?string $clienteDsmovil): void
    {
        $this->clienteDsmovil = $clienteDsmovil;
    }

    /**
     * @return string|null
     */
    public function getClienteEmail(): ?string
    {
        return $this->clienteEmail;
    }

    /**
     * @param string|null $clienteEmail
     */
    public function setClienteEmail(?string $clienteEmail): void
    {
        $this->clienteEmail = $clienteEmail;
    }

    /**
     * @return \DateTime|null
     */
    public function getClienteFcalta(): ?\DateTime
    {
        return $this->clienteFcalta;
    }

    /**
     * @param \DateTime|null $clienteFcalta
     */
    public function setClienteFcalta(?\DateTime $clienteFcalta): void
    {
        $this->clienteFcalta = $clienteFcalta;
    }

    /**
     * @return string|null
     */
    public function getClienteNif(): ?string
    {
        return $this->clienteNif;
    }

    /**
     * @param string|null $clienteNif
     */
    public function setClienteNif(?string $clienteNif): void
    {
        $this->clienteNif = $clienteNif;
    }


}
