<?php
// src/AppBundle/Controller/OfertaController.php // ... 
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class OfertaController extends Controller
{ 
    /** 
     *  @Route("/{ciudad}/ofertas/{slug}", name="oferta") 
     */ 
    public function ofertaAction($ciudad, $slug)
    {
        $em = $this->getDoctrine()->getManager();
        $oferta = $em->getRepository('AppBundle:Oferta')->findOferta($ciudad, $slug);
        if (!$oferta) {
            throw $this->createNotFoundException('No existe la oferta');
        }
        // ...
    }
}
