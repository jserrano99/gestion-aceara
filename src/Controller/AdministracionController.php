<?php

namespace App\Controller;

use App\Entity\TipoTratamiento;
use App\Form\TipoTratamientoType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdministracionController extends AbstractController
{
    /**
     * @Route("/catalogos", name="admin")
     */
    public function index(): Response
    {
        return $this->render('administracion/index.html.twig', [
            'controller_name' => 'AdministracionController',
        ]);
    }
    /**
     * @Route("/catalogos/tipoTratamiento/query", name="query_tipoTratamiento")
     */
    public function queryTipoTratamiento(): Response
    {
        $em = $this->getDoctrine()->getManager();
        $TipoTratamientoAll = $em->getRepository("App:TipoTratamiento")->findAll();


        return $this->render('administracion/Catalogos/queryTipoTratamiento.html.twig', [
            'tiposTratamiento' => $TipoTratamientoAll,
        ]);
    }

    /**
     * @Route("/catalogos/tipoTratamiento/edit/{tipoTratamiento_id}", name="edit_tipoTratamiento")
     * @param Request $request
     * @param int $tipoTratamiento_id
     * @return Response
     */
    public function editTipoTratamiento(Request $request, int $tipoTratamiento_id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $TipoTratamiento = $em->getRepository("App:TipoTratamiento")->find($tipoTratamiento_id);
        $form = $this->createForm(TipoTratamientoType::class,$TipoTratamiento);
        $form->handleRequest($request);
        if ($form->isSubmitted()){
            $this->addFlash("info"," TIPO DE TRATAMIENTO ".$TipoTratamiento->getDescripcion()." MODIFICADO CORRECTAMENTE");
            $TipoTratamiento->setCuotaIva(round($TipoTratamiento->getImporte()*0.21,2));
            $TipoTratamiento->setImporteTotal(round($TipoTratamiento->getImporte()+$TipoTratamiento->getCuotaIva(),2));
            $em->persist($TipoTratamiento);
            $em->flush();
            return $this->redirectToRoute('query_tipoTratamiento');
        }

        return $this->render('administracion/Catalogos/editTipoTratamiento.html.twig', [
            'tiposTratamiento' => $TipoTratamiento,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/catalogos/tipoTratamiento/add", name="add_tipoTratamiento")
     * @param Request $request
     * @return Response
     */
    public function addTipoTratamiento(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $TipoTratamiento = new TipoTratamiento();
        $TipoIva = $this->getDoctrine()->getRepository("App:TipoIva")->find(1);
        $TipoTratamiento->setTipoIva($TipoIva);
        $form = $this->createForm(TipoTratamientoType::class,$TipoTratamiento);
        $form->handleRequest($request);
        if ($form->isSubmitted()){
            $this->addFlash("info"," TIPO DE TRATAMIENTO ".$TipoTratamiento->getDescripcion()." CREADO CORRECTAMENTE");
            $TipoTratamiento->setCuotaIva(round($TipoTratamiento->getImporte()*0.21,2));
            $TipoTratamiento->setImporteTotal(round($TipoTratamiento->getImporte()+$TipoTratamiento->getCuotaIva(),2));
            $em->persist($TipoTratamiento);
            $em->flush();
            return $this->redirectToRoute('query_tipoTratamiento');
        }


        return $this->render('administracion/Catalogos/queryTipoTratamiento.html.twig', [
            'tiposTratamiento' => $TipoTratamiento,
            'form'=>$form->createView()
        ]);
    }
}
