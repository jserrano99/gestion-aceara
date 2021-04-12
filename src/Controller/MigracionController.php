<?php

namespace App\Controller;

use App\Entity\Cliente;
use App\Entity\CodigoPostal;
use App\Entity\Factura;
use App\Entity\FacturaLinea;
use App\Entity\Localidad;
use App\Entity\OldClientes;
use App\Entity\OldCodigosPostales;
use App\Entity\OldFacturaLinea;
use App\Entity\OldFacturas;
use App\Entity\OldTratamientoConceptos;
use App\Entity\OldTratamientos;
use App\Entity\Tratamiento;
use App\Entity\TratamientoConcepto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class MigracionController extends AbstractController
{
    /**
     * @Route("/migracion/codigospostales", name="mig_codigospostales")
     */
    public function migracionCodigosPostales(): Response
    {
        $em = $this->getDoctrine()->getManager();

        $OldCodigosPostales = $em->getRepository("App:OldCodigosPostales")->findAll();

        /** @var OldCodigosPostales $OldCodigoPostal */
        foreach ($OldCodigosPostales as $OldCodigoPostal) {
            $Provincia = $em->getRepository("App:Provincia")->find($OldCodigoPostal->getIdprovincia());
            /** @var Localidad $Localidad */
            $Localidad = $em->getRepository("App:Localidad")
                ->findOneBy(["provincia" => $Provincia, "codigo" => $OldCodigoPostal->getIdlocalidad()]);
            if (is_null($Localidad)) continue;
            $CodigoPostal = new CodigoPostal();
            $CodigoPostal->setCodigo($OldCodigoPostal->getCdpostal());
            $CodigoPostal->setLocalidad($Localidad);
            $em->persist($CodigoPostal);
            $em->flush();
        }
        return new Response();
    }

    /**
     * @Route("/migracion/clientes", name="mig_clientes")
     */
    public function migracionClientes(): Response
    {

        $OldClientes = $this->getDoctrine()->getManager()->getRepository("App:OldClientes")->findBy(["migrado" => 0]);
        dump(" CARGA MASIVA CLIENTES A CARGAR");
        dump($OldClientes);
        /** @var OldClientes $OldCliente */
        foreach ($OldClientes as $OldCliente) {
            $this->cargaCLiente($OldCliente);
        }
        die();
        return new Response();
    }

    /**
     * @Route("/migracion/cliente/{oldcliente_id}", name="mig_cliente")
     */
    public function migracionCliente(int $oldcliente_id): Response
    {
        $em = $this->getDoctrine()->getManager();

        /** @var OldClientes $OldCliente */
        $OldCliente = $em->getRepository("App:OldClientes")->find($oldcliente_id);
        dump("CLIENTE A CARGAR ");
        dump($OldCliente);
        $this->cargaCLiente($OldCliente);
        die();
        return new Response();
    }

    /**
     * @param OldClientes $OldCliente
     * @return bool
     */
    public function cargaCLiente(OldClientes $OldCliente)
    {
        $em = $this->getDoctrine()->getManager();
        $ControlCliente = $em->getRepository("App:Cliente")->findOneBy(["idAnterior" => $OldCliente->getClienteId()]);
        if ($ControlCliente) {
            $em->remove($ControlCliente);
            $em->flush();
        }
        $Cliente = new Cliente();
        $Cliente->setAlias($OldCliente->getClienteDs());
        $Cliente->setNombre($OldCliente->getClienteDsnombre());
        $Cliente->setApellido1($OldCliente->getClienteDsapellido1());
        $Cliente->setApellido2($OldCliente->getClienteDsapellido2());
        $Cliente->setDomicilio($OldCliente->getClienteDsdomicilio());
        /** @var CodigoPostal $CodigoPostal */
        $CodigoPostal = $em->getRepository("App:CodigoPostal")->findOneBy(["codigo" => $OldCliente->getClienteCdpostal()]);
        if ($CodigoPostal) {
            $Cliente->setCodigoPostal($CodigoPostal->getCodigo());
            $Cliente->setLocalidad($CodigoPostal->getLocalidad());
        }
        $Cliente->setComentarios($OldCliente->getClienteDscomentarios());
        is_null($OldCliente->getClienteEmail()) ? null : $Cliente->setEmail($OldCliente->getClienteEmail());
        $Cliente->setFechaAlta($OldCliente->getClienteFcalta());
        $Cliente->setFechaNacimiento($OldCliente->getClienteFcnacimiento());
        $Cliente->setMovil($OldCliente->getClienteDsmovil());
        $Cliente->setNif($OldCliente->getClienteNif());
        $Cliente->setProfesion($OldCliente->getClienteDsprofesion());
        is_null($OldCliente->getClienteDstelefono()) ? null : $Cliente->setTelefono($OldCliente->getClienteDstelefono());
        $Cliente->setIdAnterior($OldCliente->getClienteId());
        $em->persist($Cliente);
        $em->flush();
        dump("NUEVO CLIENTE");
        dump($Cliente);
        $OldTratamientos = $em->getRepository("App:OldTratamientos")->findBy(["tratamientoIdcliente" => $OldCliente->getClienteId()]);
        dump("TRATAMIENTOS ANTERIORES");
        dump($OldTratamientos);
        /** @var OldTratamientos $oldTratamiento */
        foreach ($OldTratamientos as $oldTratamiento) {
            dump($oldTratamiento);
            if (!is_null($oldTratamiento->getTratamientoFecha())) {
                $Tratamiento = new Tratamiento();
                $Tratamiento->setCliente($Cliente);
                $Tratamiento->setDescripcion($oldTratamiento->getTratamientoDstratamiento());
                $Tratamiento->setMotivoConsulta($oldTratamiento->getTratamientoDsmotivo());
                $Tratamiento->setFechaTratamiento($oldTratamiento->getTratamientoFecha());
                $em->persist($Tratamiento);
                $em->flush();
                dump("NUEVO TRATAMIENTO");
                dump($Tratamiento);
                $OldTratamientoConceptos = $em->getRepository("App:OldTratamientoConceptos")->findBy(["idtratamiento" => $oldTratamiento->getTratamientoId()]);
                /** @var OldTratamientoConceptos $oldTratamientoConcepto */
                foreach ($OldTratamientoConceptos as $oldTratamientoConcepto) {
                    $TratamientoConcepto = new TratamientoConcepto();
                    $TratamientoConcepto->setTratamiento($Tratamiento);
                    $TratamientoConcepto->setUnidades($oldTratamientoConcepto->getNmunidades());
                    /** @var  $TipoTratamiento $TipoTratamiento */
                    $TipoTratamiento = $em->getRepository("App:TipoTratamiento")->findOneBy(["descripcion" => $oldTratamientoConcepto->getDstipotratamiento()]);
                    $TratamientoConcepto->setTipoTratamiento($TipoTratamiento);
                    $em->persist($TratamientoConcepto);
                    $em->flush();
                }
                $OldFacturas = $em->getRepository("App:OldFacturas")->findBy(["idtratamiento" => $oldTratamiento->getTratamientoId()]);
                /** @var OldFacturas $oldFactura */
                foreach ($OldFacturas as $oldFactura) {
                    $Factura = new Factura();
                    $Factura->setCliente($Cliente);
                    $Factura->setTratamiento($Tratamiento);
                    $Factura->setFechaFactura($oldFactura->getFcfactura());
                    $Factura->setNumero($oldFactura->getNmfactura());
                    $Factura->setSerie($oldFactura->getSerie());
                    $em->persist($Factura);
                    $em->flush();
                    $OldFacturaLineas = $em->getRepository("App:OldFacturaLinea")->findBy(["idfactura" => $oldFactura->getIdfactura()]);
                    /** @var OldFacturaLinea $oldFacturaLinea */
                    foreach ($OldFacturaLineas as $oldFacturaLinea) {
                        $FacturaLinea = new FacturaLinea();
                        $FacturaLinea->setFactura($Factura);
                        $FacturaLinea->setUnidades($oldFacturaLinea->getNmunidades());
                        $FacturaLinea->setConcepto($oldFacturaLinea->getDstipotratamiento());
                        $FacturaLinea->setCuotaIva($oldFacturaLinea->getNmcuotaiva());
                        $FacturaLinea->setImporteTotal($oldFacturaLinea->getNmimportetotal());
                        $FacturaLinea->setImporteUnitario($oldFacturaLinea->getNmimporteunitario());
                        $em->persist($FacturaLinea);
                        $em->flush();
                    }
                }
            }
        }

        $OldCliente->setMigrado(1);
        $em->persist($OldCliente);
        $em->flush();
        return true;
    }
}