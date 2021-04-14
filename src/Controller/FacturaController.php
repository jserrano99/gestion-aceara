<?php

namespace App\Controller;

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
     * @Route("/factura/edit/{factura_id}", name="edit_factura")
     */
    public function editFactura(): Response
    {
        return $this->render('factura/index.html.twig', [
            'controller_name' => 'FacturaController',
        ]);
    }

    /**
     * @Route("/factura/ver/{factura_id}", name="ver_factura")
     * @param int $factura_id
     * @return Response
     */
    public function verFactura(int $factura_id): Response
    {
        return $this->render('factura/index.html.twig', [
            'controller_name' => 'FacturaController',
        ]);
    }

    /**
     * @Route("/factura/generar/{tratamiento_id}", name="generar_factura")
     * @param int $tratamiento_id
     * @return Response
     */
    public function generarFactura(int $tratamiento_id): Response
    {
        return $this->render('factura/index.html.twig', [
            'controller_name' => 'FacturaController',
        ]);
    }
}
