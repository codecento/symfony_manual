<?php

// src/AppBundle/Controller/CiudadController.php 
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CiudadController extends Controller
{
    /**
     * @Route("/ciudad/cambiar-a-{ciudad}",
     * requirements={ "ciudad" = ".+" },
     * name="ciudad_cambiar"), 
     */
    public function cambiarAction($ciudad)
    {
        return $this->redirectToRoute('portada', array('ciudad' => $ciudad));
    }

    public function listaCiudadesAction($ciudad)
    {
        $em = $this->getDoctrine()->getManager();
        $ciudades = $em->getRepository('AppBundle:Ciudad')->findAll();
        return $this->render('ciudad/_lista_ciudades.html.twig', array('ciudades' => $ciudades, 'ciudadActual' => $ciudad));
    }

    /** @Route( 
     * "/{ciudad}/recientes.{_format}",
     * defaults = { "_format" = "html" }, 
     * name="ciudad_recientes" 
     * ) 
     */
    public function recientesAction($ciudad)
    {
        $em = $this->getDoctrine()->getManager();
        $ciudad = $em->getRepository('AppBundle:Ciudad')->findOneBySlug($ciudad);
        if (!$ciudad) {
            throw $this->createNotFoundException('No existe la ciudad');
        }

        $cercanas = $em->getRepository('AppBundle:Ciudad')->findCercanas($ciudad->getId());
        $ofertas = $em->getRepository('AppBundle:Oferta')->findRecientes($ciudad->getId());

        $formato = $request->getRequestFormat();

        return $this->render('ciudad/recientes.'.$formato.'.twig', array('ciudad' => $ciudad, 'cercanas' => $cercanas, 'ofertas' => $ofertas));
    }
}
