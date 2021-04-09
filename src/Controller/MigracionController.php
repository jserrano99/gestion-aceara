<?php

namespace App\Controller;

use App\Entity\CodigoPostal;
use App\Entity\Localidad;
use App\Entity\OldCodigosPostales;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class MigracionController extends AbstractController
{
    /**
     * @Route("/migracion", name="migracion")
     */
    public function migracion(): Response
    {
        $em = $this->getDoctrine()->getManager();

        $OldCodigosPostales = $em->getRepository("App:OldCodigosPostales")->findAll();

        /** @var OldCodigosPostales $OldCodigoPostal */
        foreach ($OldCodigosPostales as $OldCodigoPostal) {
            $Provincia = $em->getRepository("App:Provincia")->find($OldCodigoPostal->getIdprovincia());
            /** @var Localidad $Localidad */
            $Localidad = $em->getRepository("App:Localidad")
                ->findOneBy(["provincia" => $Provincia, "codigo" => $OldCodigoPostal->getIdlocalidad()]);
            if ( is_null($Localidad) ) continue;
            $CodigoPostal = new CodigoPostal();
            $CodigoPostal->setCodigo($OldCodigoPostal->getCdpostal());
            $CodigoPostal->setLocalidad($Localidad);
            $em->persist($CodigoPostal);
            $em->flush();
        }
        return new Response();

        /** Migración Codigos Postales */

        /** migración de clientes, tratamientos y facturas $em */


    }
}
