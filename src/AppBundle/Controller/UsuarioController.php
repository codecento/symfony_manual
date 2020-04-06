<?php
// src/AppBundle/Controller/UsuarioController.php 
namespace AppBundle\Controller;

use AppBundle\Entity\Usuario;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 *  @Route("/usuario") 
 */
class UsuarioController extends Controller
{
    /**
     * @Route("/login", name="usuario_login") 
     */
    public function loginAction()
    {
        $authUtils = $this->get('security.authentication_utils');
        return $this->render('usuario/login.html.twig', array('last_username' => $authUtils->getLastUsername(), 'error' => $authUtils->getLastAuthenticationError(),));
    }

    /**
     * @Route("/login_check", name="usuario_login_check") 
     */
    public function loginCheckAction()
    {
        //Symfony lo hace automáticamente
    }

    /** 
     * @Route("/logout", name="usuario_logout") 
     */
    public function logoutAction()
    {
        //Symfony lo hace automáticamente
    }
    /**
     *  @Route("/compras", name="usuario_compras") 
     */
    public function comprasAction()
    {
        $usuarioId = 401;
        $em = $this->getDoctrine()->getManager();
        $compras = $em->getRepository('AppBundle:Usuario')->findTodasLasCompras($usuarioId);
        return $this->render('usuario/compras.html.twig', array('compras' => $compras));
    }

    public function cajaLoginAction()
    {
        $authUtils = $this->get('security.authentication_utils');
        return $this->render('usuario/_caja_login.html.twig', array('last_username' => $authUtils->getLastUsername(), 'error' => $authUtils->getLastAuthenticationError(),));
    }

    /**
     * @Route("/registro", name="usuario_registro") 
     */
    public function registroAction(Request $request)
    {
        $usuario = new Usuario();
        $formulario = $this->createForm('AppBundle\Form\UsuarioType', $usuario);
        return $this->render('usuario/registro.html.twig', array('formulario' => $formulario->createView()));
    }
}