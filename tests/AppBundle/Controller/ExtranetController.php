<?php
// src/AppBundle/Controller/ExtranetController.php 
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/** * @Route("/extranet") */ 
class ExtranetController extends Controller
{
    /**
     * @Route("/", name="extranet_portada")
     */ 
    public function portadaAction()
    {

    }

    /** 
     * @Route("/oferta/ventas/{id}", name="extranet_oferta_ventas") 
     */ 
    public function ofertaVentasAction()
    {

    }

    /** 
     * @Route("/oferta/nueva", name="extranet_oferta_nueva") 
     */ 
    public function ofertaNuevaAction()
    {

    }

    /** 
     * @Route("/oferta/editar/{id}", name="extranet_oferta_editar") 
     */ 
     public function ofertaEditarAction()
    {
    }

    /**
     * @Route("/perfil", name="extranet_perfil")
     */ public function perfilAction()
    {
        
    }
}
