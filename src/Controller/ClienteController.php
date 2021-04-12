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
     * @Route("/cliente/tratamiento/query/{cliente_id}", name="query_tratamientos")
     * @param Request $request
     * @param int $cliente_id
     * @return JsonResponse|Response
     */

    public function queryTratamientos(Request $request,int $cliente_id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $Cliente = $em->getRepository("App:Cliente")->find($cliente_id);


        return $this->render('cliente/queryTratamientos.html.twig', [
            'cliente' => $Cliente,
            'tratamientos' => $Cliente->getTratamientos()
        ]);
    }

    /**
     * @Route("/cliente/tratamiento/edit/{tratamiento_id}", name="edit_tratamiento")
     * @param Request $request
     * @param int $cliente_id
     * @return JsonResponse|Response
     */

    public function editTratamiento(Request $request,int $tratamiento_id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $Tratamiento = $em->getRepository("App:Tratamiento")->find($tratamiento_id);


        return $this->render('cliente/editTratamiento.html.twig', [
            'cliente' => $Tratamiento->getCliente(),
            'tratamiento' => $Tratamiento
        ]);
    }



}

