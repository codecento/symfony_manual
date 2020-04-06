<?php
// src/AppBundle/Controller/UsuarioController.php 
namespace AppBundle\Controller;

use AppBundle\Entity\Usuario;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

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
        $usuario->setPermiteEmail(true);

        $formulario = $this->createForm('AppBundle\Form\UsuarioType', $usuario);

        $formulario->handleRequest($request);
        if ($formulario->isValid()) {
            $this->addFlash('info', '¡Enhorabuena! Te has registrado correctamen te en Cupon');

            $encoder = $this->get('security.encoder_factory')->getEncoder($usuario);
            $passwordCodificado = $encoder->encodePassword($usuario->getPassword(), null);
            $usuario->setPassword($passwordCodificado);

            $em = $this->getDoctrine()->getManager();
            $em->persist($usuario);
            $em->flush();

            $token = new UsernamePasswordToken($usuario, $usuario->getPassword(), 'frontend', $usuario->getRoles());
            $this->container->get('security.token_storage')->setToken($token);

            return $this->redirectToRoute('portada', array( 'ciudad' => $usuario->getCiudad()->getSlug() ));

        }


        return $this->render('usuario/registro.html.twig', array('formulario' => $formulario->createView()));
    }
}
