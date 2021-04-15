<?php

namespace App\Controller;

use App\Entity\Factura;
use App\Entity\FacturaLinea;
use App\Entity\Tratamiento;
use App\Entity\TratamientoConcepto;
use App\Form\FacturaType;
use Doctrine\DBAL\Connection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FacturaController extends AbstractController
{
    /**
     * @Route("/factura/query/", name="query_facturas")
     * @param Request $request
     * @return JsonResponse|Response
     */

    public function queryFacturas(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $Facturas = $em->getRepository("App:Factura")->findAll();

        return $this->render('factura/queryFacturas.html.twig', [
            'facturas' => $Facturas
        ]);
    }

    /**
     * @Route("/factura/query/cliente/{cliente_id}", name="query_facturas_cliente")
     * @param $cliente_id
     * @return JsonResponse|Response
     */

    public function queryFacturasCliente(int $cliente_id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $Cliente =$em->getRepository("App:Cliente")->find($cliente_id);
        $Facturas = $em->getRepository("App:Factura")->findBy(["cliente" => $Cliente]);

        return $this->render('factura/queryFacturas.html.twig', [
            'facturas' => $Facturas
        ]);
    }
    /**
     * @Route("/factura/ver/{factura_id}", name="ver_factura")
     * @param Request $request
     * @param int $factura_id
     * @return Response
     */
    public function verFactura(Request $request ,int $factura_id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $Factura = $em->getRepository("App:Factura")->find($factura_id);

        $form = $this->createForm(FacturaType::class, $Factura);
                $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $this->addFlash("info", "Factura Modificada correctamente");
            $em->persist($Factura);
            $em->flush();
        }

        return $this->render('factura/editFactura.html.twig', [
            'factura' => $Factura,
            'lineas' =>$Factura->getfacturaLineas(),
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/factura/generar/{tratamiento_id}", name="generar_factura")
     * @param int $tratamiento_id
     * @return Response
     * @throws \Doctrine\DBAL\Exception
     */
    public function generarFactura(int $tratamiento_id): Response
    {
        $em = $this->getDoctrine()->getManager();

        /** @var Tratamiento $Tratamiento */
        $Tratamiento = $em->getRepository("App:Tratamiento")->find($tratamiento_id);

        if (is_null($Tratamiento->getCliente()->getNif())) {
            $this->addFlash("error", "CLIENTE SIN NIF NO SE PUEDE GENERAR FACTURA");
            return $this->redirectToRoute("edit_cliente",["cliente_id"=>$Tratamiento->getCliente()->getId()]);
        }

        if ($Tratamiento->getConceptos()->isEmpty()) {
            $this->addFlash("error", "TRATAMIENTO SIN CONCEPTOS NO SE PUEDE GENERAR FACTURA");
            return $this->redirectToRoute("edit_tratamiento",["tratamiento_id"=>$Tratamiento->getId()]);
        }
        $serie = $Tratamiento->getFechaTratamiento()->format("Y");
        $query = "select max(numero)+1 as siguienteNumero from factura where serie = ".$serie;
        /** @var Connection $con */
        $con = $this->getDoctrine()->getConnection();
        $st = $con->executeQuery($query);
        $resultado = $st->fetch();

        $Factura = new Factura();
        $Factura->setCliente($Tratamiento->getCliente());
        $Factura->setTratamiento($Tratamiento);
        $Factura->setSerie($serie);
        $Factura->setNumero($resultado["siguienteNumero"]);
        $Factura->setFechaFactura($Tratamiento->getFechaTratamiento());
        $Factura->setTotalConcepto(0);
        $Factura->setTotalCuotaIva(0);
        $Factura->setTotalfactura(0);
        $em->persist($Factura);
        $em->flush();
        $totalConcepto = 0;
        $totalCuotaIva = 0;
        $totalfactura = 0;
        $Conceptos = $em->getRepository("App:TratamientoConcepto")->findBy(["tratamiento" => $Tratamiento]);
        /** @var TratamientoConcepto $concepto */
        foreach ($Conceptos as $concepto) {
            $FacturaLinea = new FacturaLinea();
            $FacturaLinea->setFactura($Factura);
            $FacturaLinea->setImporteTotal($concepto->getImporteTotal());
            $FacturaLinea->setCuotaIva($concepto->getCuotaIva());
            $FacturaLinea->setPorcentajeIva($concepto->getPorcentajeIva());
            $FacturaLinea->setImporteConcepto($concepto->getImporteConcepto());
            $FacturaLinea->setImporteUnitario($concepto->getImporteUnitario());
            $FacturaLinea->setUnidades($concepto->getUnidades());
            $FacturaLinea->setConcepto($concepto->getDescripcion());
            $em->persist($FacturaLinea);
            $em->flush();
            $totalConcepto = $totalConcepto + $concepto->getImporteConcepto();
            $totalCuotaIva = $totalCuotaIva + $concepto->getCuotaIva();
            $totalfactura = $totalfactura + $concepto->getImporteTotal();
        }

        $Factura->setTotalConcepto($totalConcepto);
        $Factura->setTotalCuotaIva($totalCuotaIva);
        $Factura->setTotalfactura($totalfactura);
        $em->persist($Factura);
        $em->flush();

        $this->addFlash("info","Factura Generada Correctamente");
        return $this->redirectToRoute("ver_factura",["factura_id" => $Factura->getId()]);
    }



    /**
     * @Route("/factura/delete/{factura_id}",options={"expose"=true}, name="delete_factura")
     */
    public function deleteFactura(int $factura_id): Response
    {
        $em =$this->getDoctrine()->getManager();
        /** @var Factura $Factura */
        $Factura = $em->getRepository("App:Factura")->find($factura_id);
        $this->addFlash("info","Factura "
            .$Factura->getNumero()
            ."/"
            .$Factura->getSerie()
            ." de "
            .$Factura->getFechaFactura()->format('d/m/Y')
            ."eliminada correctamente");
        $em->remove($Factura);
        $em->flush();

        return $this->redirectToRoute("query_facturas");
    }

}
