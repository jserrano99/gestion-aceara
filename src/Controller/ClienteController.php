<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClienteController extends AbstractController
{
    /**
     * @Route("/cliente/query", name="query_cliente")
     * @param Request $request
     * @return JsonResponse|Response
     * @throws \Exception
     */

    public function queryClientes(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $Clientes = $em->getRepository("App:Cliente")->findAll();

        return $this->render('cliente/queryCliente.html.twig', [
            'clientes' => $Clientes,
        ]);
    }

    /**
     * @Route("/cliente/tratamientos/query", name="query_tratamientos")
     * @param Request $request
     * @param int $cliente_id
     * @return JsonResponse|Response
     */

    public function queryTratamientos(Request $request,int $cliente_id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $Cliente = $em->getRepository("App:Cliente")->find($cliente_id);
        $Tratamientos = $em->getRepository("App:Tratamiento")->findBy(['cliente'=> $Cliente]);


        return $this->render('cliente/queryTratamientos.html.twig', [
            'cliente' => $Cliente,
            'tratamientos' => $Tratamientos
        ]);
    }

}

