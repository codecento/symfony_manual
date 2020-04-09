<?php
// src/AppBundle/Controller/ExtranetController.php 
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ExtranetController extends Controller
{
    /**
     * @Route("/login", name="extranet_login") 
     */
    public function loginAction()
    {
        $authUtils = $this->get('security.authentication_utils');
        return $this->render('extranet/login.html.twig', array('last_username' => $authUtils->getLastUsername(), 'error' => $authUtils->getLastAuthenticationError(),));
    }
    /** 
     * @Route("/login_check", name="extranet_login_check") 
     */
    public function loginCheckAction()
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

    public function ofertaEditarAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $ventas = $em->getRepository('AppBundle:Oferta')->findVentasByOferta($id);
        return $this->render('extranet/ventas.html.twig', array('oferta' => $ventas[0]->getOferta(), 'ventas' => $ventas));
    }

    public function portadaAction()
    {
        $em = $this->getDoctrine()->getManager();
        $tienda = $this->getUser();
        $ofertas = $em->getRepository('AppBundle:Tienda')->findOfertasRecientes($tienda->getId());
        return $this->render('extranet/portada.html.twig', array('ofertas' => $ofertas));
    }

    public function perfilAction(Request $request)
    {
        $tienda = $this->getUser();
        $formulario = $this->createForm('AppBundle\Form\TiendaType', $tienda);
        $formulario->handleRequest($request);
        if ($formulario->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tienda);
            $em->flush();
            $this->addFlash('info', 'Los datos de tu perfil se han actualizado correctamente');
            return $this->redirectToRoute('extranet_portada');
        }
        return $this->render('extranet/perfil.html.twig', array('tienda' => $tienda, 'formulario' => $formulario->createView()));
    }
}
