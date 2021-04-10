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
        $em = $this->getDoctrine()->getManager();


        $OldClientes = $em->getRepository("App:OldClientes")->findAll();

        /** @var OldClientes $OldCliente */
        foreach ($OldClientes as $OldCliente) {
            $Cliente = new Cliente();
            $Cliente->setAlias($OldCliente->getClienteDs());
            $Cliente->setNombre($OldCliente->getClienteDsnombre());
            $Cliente->setApellido1($OldCliente->getClienteDsapellido1());
            $Cliente->setApellido2($OldCliente->getClienteDsapellido2());
            $Cliente->setDomicilio($OldCliente->getClienteDsdomicilio());
            /** @var CodigoPostal $CodigoPostal */
            $CodigoPostal = $em->getRepository("App:CodigoPostal")->findOneBy(["codigo" => $OldCliente->getClienteCdpostal()]);
            if ($CodigoPostal ) $Cliente->setCodigoPostal($CodigoPostal->getCodigo());
            $Cliente->setLocalidad($CodigoPostal->getLocalidad());
            $Cliente->setComentarios($OldCliente->getClienteDscomentarios());
            $Cliente->setEmail($OldCliente->getClienteEmail());
            $Cliente->setFechaAlta($OldCliente->getClienteFcalta());
            $Cliente->setFechaNacimiento($OldCliente->getClienteFcnacimiento());
            $Cliente->setMovil($OldCliente->getClienteDsmovil());
            $Cliente->setNif($OldCliente->getClienteNif());
            $Cliente->setProfesion($OldCliente->getClienteDsprofesion());
            $Cliente->setTelefono($OldCliente->getClienteDstelefono());
            $Cliente->setIdAnterior($OldCliente->getClienteId());
            $em->persist($Cliente);
            $em->flush();
            $OldTratamientos = $em->getRepository("App:OldTratamientos")->findBy(["tratamientoIdcliente" => $OldCliente->getClienteId()]);
            /** @var OldTratamientos $oldTratamiento */
            foreach ($OldTratamientos as $oldTratamiento) {
                if (is_null($oldTratamiento->getTratamientoFecha())) continue;
                $Tratamiento = new Tratamiento();
                $Tratamiento->setCliente($Cliente);
                $Tratamiento->setDescripcion($oldTratamiento->getTratamientoDstratamiento());
                $Tratamiento->setMotivoConsulta($oldTratamiento->getTratamientoDsmotivo());
                $Tratamiento->setFechaTratamiento($oldTratamiento->getTratamientoFecha());
                $em->persist($Tratamiento);
                $em->flush();
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
        return new Response();
    }
}