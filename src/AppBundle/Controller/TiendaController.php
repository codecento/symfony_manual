<?php
// src/AppBundle/Controller/TiendaController.php 

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\BrowserKit\Request;


class TiendaController extends Controller
{
    /** 
     * @Route("/{ciudad}/tiendas/{tienda}", requirements={ "ciudad" = ".+" }, name="tienda_portada") 
     */
    public function portadaAction(Request $request, $ciudad, $tienda)
    {
        $em = $this->getDoctrine()->getManager();
        $ciudad = $em->getRepository('AppBundle:Ciudad')->findOneBySlug($ciudad);
        $tienda = $em->getRepository('AppBundle:Tienda')->findOneBy(array('slug' => $tienda, 'ciudad' => $ciudad->getId()));
        if (!$tienda) {
            throw $this->createNotFoundException('No existe esta tienda');
        }
        $ofertas = $em->getRepository('AppBundle:Tienda')->findUltimasOfertasPublicadas($tienda->getId());
        $cercanas = $em->getRepository('AppBundle:Tienda')->findCercanas($tienda->getSlug(), $tienda->getCiudad()->getSlug());

        $formato = $this->get('request')->getRequestFormat();
        return $this->render('tienda/portada.' . $formato . '.twig', array('tienda' => $tienda, 'ofertas' => $ofertas, 'cercanas' => $cercanas));
    }
    // ...
}
