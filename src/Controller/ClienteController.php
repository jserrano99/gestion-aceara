<?php

namespace App\Controller;

use App\Entity\Cliente;
use App\Form\ClienteType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class ClienteController extends AbstractController
{
    /**
     * @var Session
     */
    private $sesion;

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
     * @Route("/cliente/edit/{cliente_id}", name="edit_cliente")
     * @param Request $request
     * @param int $cliente_id
     * @return JsonResponse|Response
     */

    public function editCliente(Request $request,int $cliente_id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $Cliente = $em->getRepository("App:Cliente")->find($cliente_id);

        $form = $this->createForm(ClienteType::class, $Cliente);
        $form->handleRequest($request);
        if ($form->isSubmitted() ) {
            $CodigoPostal = $em->getRepository("App:CodigoPostal")->findOneBy(["codigo" => $Cliente->getCodigoPostal()]);
            if ($CodigoPostal) $Cliente->setLocalidad($CodigoPostal->getLocalidad());
            $em->persist($Cliente);
            $em->flush();
        }

        return $this->render('cliente/editCliente.html.twig', [
            'cliente' => $Cliente,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/cliente/add/", name="add_cliente")
     * @param Request $request
     * @return JsonResponse|Response
     */

    public function addCliente(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $Cliente = new Cliente();

        $form = $this->createForm(ClienteType::class, $Cliente);
        $form->handleRequest($request);
        if ($form->isSubmitted() ) {
            $CodigoPostal = $em->getRepository("App:CodigoPostal")->findOneBy(["codigo" => $form->getData('codigoPostal')]);
            If ($CodigoPostal) $Cliente->setLocalidad($CodigoPostal->getLocalidad());
            $em->persist($Cliente);
            $em->flush();
        }
        return $this->render('cliente/editCliente.html.twig', [
            'cliente' => $Cliente,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/cliente/delete/{cliente_id}", options={"expose"=true},name="delete_cliente")
     * @param Request $request
     * @param int $cliente_id
     * @return JsonResponse|Response
     */

    public function deleteCliente(Request $request,int $cliente_id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $Cliente = $em->getRepository("App:Cliente")->find($cliente_id);
        $status = " CLIENTE ID " . $Cliente->getId().' '.$Cliente->getAlias(). ' CORRECTAMENTE ELIMININADO';
        $this->addFlash("info", $status);
        $em->remove($Cliente);
        $em->flush();
        return $this->redirectToRoute("query_cliente");
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

