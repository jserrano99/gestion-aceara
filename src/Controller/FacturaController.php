<?php

namespace App\Controller;

use App\Entity\Factura;
use App\Entity\FacturaLinea;
use App\Entity\Tratamiento;
use App\Entity\TratamientoConcepto;
use App\Form\FacturaType;
use App\Form\FiltroFechasType;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\DBAL\Connection;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Knp\Snappy\Pdf;
use PhpOffice\PhpSpreadsheet\Calculation\DateTime;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
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
        $Facturas = $em->getRepository("App:Factura")
            ->createQueryBuilder('u')
            ->orderBy('u.serie, u.numero')
            ->getQuery()->getResult() ;

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
        $Cliente = $em->getRepository("App:Cliente")->find($cliente_id);
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
    public function verFactura(Request $request, int $factura_id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $Factura = $em->getRepository("App:Factura")->find($factura_id);

        $form = $this->createForm(FacturaType::class, $Factura);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $this->addFlash("info", "Factura Modificada correctamente");
            $em->persist($Factura);
            $em->flush();
            return $this->redirectToRoute('ver_factura', ["factura_id" => $Factura->getId()]);
        }

        return $this->render('factura/editFactura.html.twig', [
            'factura' => $Factura,
            'lineas' => $Factura->getfacturaLineas(),
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
            return $this->redirectToRoute("edit_cliente", ["cliente_id" => $Tratamiento->getCliente()->getId()]);
        }

        if ($Tratamiento->getConceptos()->isEmpty()) {
            $this->addFlash("error", "TRATAMIENTO SIN CONCEPTOS NO SE PUEDE GENERAR FACTURA");
            return $this->redirectToRoute("edit_tratamiento", ["tratamiento_id" => $Tratamiento->getId()]);
        }

        if (is_null($Tratamiento->getCliente()->getDomicilio())) {
            $this->addFlash("error", "CLIENTE SIN DOMICILIO NO SE PUEDE GENERAR FACTURA");
            return $this->redirectToRoute("edit_cliente", ["cliente_id" => $Tratamiento->getCliente()->getId()]);
        }

        $serie = $Tratamiento->getFechaTratamiento()->format("Y");
        $query = "select max(numero)+1 as siguienteNumero from factura where serie = " . $serie;
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

        $this->addFlash("info", "Factura Generada Correctamente");
        return $this->redirectToRoute("ver_factura", ["factura_id" => $Factura->getId()]);
    }


    /**
     * @Route("/factura/delete/{factura_id}",options={"expose"=true}, name="delete_factura")
     */
    public function deleteFactura(int $factura_id): Response
    {
        $em = $this->getDoctrine()->getManager();
        /** @var Factura $Factura */
        $Factura = $em->getRepository("App:Factura")->find($factura_id);
        $this->addFlash("info", "Factura "
            . $Factura->getNumero()
            . "/"
            . $Factura->getSerie()
            . " de "
            . $Factura->getFechaFactura()->format('d/m/Y')
            . "eliminada correctamente");
        $em->remove($Factura);
        $em->flush();

        return $this->redirectToRoute("query_facturas");
    }


    /**
     * @Route("/factura/imprimir/{factura_id}",options={"expose"=true}, name="imprimir_factura",)
     * @param int $factura_id
     * @return Response
     */
    public function imprimirFactura(int $factura_id, Pdf $pdf): Response
    {
        $em = $this->getDoctrine()->getManager();
        /** @var Factura $Factura */
        $Factura = $em->getRepository("App:Factura")->find($factura_id);
        $html = $this->renderView('factura/factura.html.twig', ["factura" => $Factura]);
        $filename = "Factura-" . $Factura->getCliente()->getNif() . '-' . $Factura->getSerie() . '-' . $Factura->getNumero() . '.pdf';
        return new PdfResponse($pdf->getOutputFromHtml($html), $filename);

    }

    /**
     * @Route("/factura/exportar/", name="exportar_facturas")
     * @return Response
     */
    public function exportarFacturas(Request $request): Response
    {
        $form = $this->createForm(FiltroFechasType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $fechaInicio = $form["fechaInicio"]->getData();
            $fechaFin = $form["fechaFin"]->getData();
            $Facturas = $this->getDoctrine()->getManager()->getRepository("App:Factura")
                ->createQueryBuilder('u')
                ->where('u.fechaFactura between :fechaInicio and :fechaFin')
                ->setParameter('fechaInicio', $fechaInicio)
                ->setParameter('fechaFin',$fechaFin)
                ->orderBy('u.serie, u.numero')
                ->getQuery()->getResult();
            return $this->exportar($Facturas,$fechaInicio,$fechaFin);
        }

        return $this->render('factura/exportarFactura.html.twig', ["form" => $form->createView()]);

    }


    /**
     * @param $Facturas
     * @param \DateTime $fechaInicio
     * @param \DateTime $fechaFin
     * @return Response
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Reader\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function exportar($Facturas, \DateTime $fechaInicio, \DateTime $fechaFin): Response
    {

        $reader = IOFactory::createReader('Xlsx');
        /** @var Spreadsheet $sheet */
        $Spreadsheet = $reader->load('Plantillas/PlantillaFacturas.xlsx');
        $sheet = $Spreadsheet->getActiveSheet();
        $sheet->setCellValue('F10', "Selección=> Desde:". $fechaInicio->format('d/m/Y').
            '  HASTA: '. $fechaFin->format('D/m/Y'));
        $row = 15;
        $orden =1;
        /** @var Factura $Factura */
        foreach ($Facturas as $Factura)
        {
            $sheet->insertNewRowBefore($row, 1);
            $sheet->setCellValue('B' . $row, $orden);
            $sheet->setCellValue('C' . $row, $Factura->getSerie());
            $sheet->setCellValue('D' . $row, $Factura->getNumero());
            $sheet->setCellValue('E' . $row, $Factura->getFechaFactura()->format('d/m/Y'));
            $sheet->setCellValue('F' . $row, $Factura->getCliente()->getNif());
            $sheet->setCellValue('G' . $row, $Factura->getCliente()->getApenom());
            $sheet->setCellValue('H' . $row, $Factura->getTotalConcepto());
            $sheet->setCellValue('I' . $row, $Factura->getTotalCuotaIva());
            $sheet->setCellValue('J' . $row, $Factura->getTotalfactura());
            $row++;
            $orden++;
        }

        $writer = new Xlsx($Spreadsheet);
        $fechaActual = new \DateTime();
        $filename = 'ExportacionFacturas-' .'-' . $fechaActual->format('Ymd-His') . '.xlsx';
        $writer->save($filename);

        $response = new Response();
        $response->headers->makeDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT, $filename);
        $response->headers->set('Content-Disposition', 'attachment;filename=' . $filename);
        $response->headers->set('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $response->headers->set('Pragma', 'public');
        $response->headers->set('Cache-Control', 'max-age=1');
        $response->setContent(file_get_contents($filename));
        return $response;
    }

}
