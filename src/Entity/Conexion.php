<?php

namespace App\Entity;

use App\Repository\ConexionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ConexionRepository::class)
 */
class Conexion
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fechaConexion;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="conexiones")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFechaConexion(): ?\DateTimeInterface
    {
        return $this->fechaConexion;
    }

    public function setFechaConexion(\DateTimeInterface $fechaConexion): self
    {
        $this->fechaConexion = $fechaConexion;

        return $this;
    }

    public function getUsero(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
