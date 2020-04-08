<?php
// src/AppBundle/Controller/ExtranetController.php 
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ExtranetController extends Controller
{
    /** * @Route("/login", name="extranet_login") */ public function loginAction()
    {
        $authUtils = $this->get('security.authentication_utils');
        return $this->render('extranet/login.html.twig', array('last_username' => $authUtils->getLastUsername(), 'error' => $authUtils->getLastAuthenticationError(),));
    }
    /** * @Route("/login_check", name="extranet_login_check") */ public function loginCheckAction()
    { 
        // el "login check" lo hace Symfony automáticamente, por lo que // no hay que añadir ningún código en este método 
    }

    /** 
     * @Route("/logout", name="extranet_logout") 
     */ 
    public function logoutAction()
    { 
        // el logout lo hace Symfony automáticamente, por lo que // no hay que añadir ningún código en este método 
    }
  
}
