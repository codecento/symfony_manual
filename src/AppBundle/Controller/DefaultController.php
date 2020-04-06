<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/{ciudad}", defaults = {"ciudad" = "%app.ciudad_por_defecto%"}, name="portada")
     * @Route("/")
     */
    public function portadaAction($ciudad)
    {
        if (null === $ciudad) {
            return $this->redirectToRoute('portada', array('ciudad' => $this->getParameter('app.ciudad_por_defecto')));
        }

        $em = $this->getDoctrine()->getManager();
        $oferta = $em->getRepository('AppBundle:Oferta')->findOfertaDelDia($ciudad);

        if (!$oferta) {
            throw $this->createNotFoundException(
                'No se ha encontrado la oferta del día en la ciudad seleccionada'
            );
        }

        return $this->render('portada.html.twig', array('oferta' => $oferta));
    }

    public function paginaAction()
    {
        return $this->render('sitio/ayuda.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
        ]);
    }

    /** * @Route("/{ciudad}/ofertas/{slug}", name="oferta") */
    public function ofertaAction($ciudad, $slug)
    {
        $em = $this->getDoctrine()->getManager();
        $oferta = $em->getRepository('AppBundle:Oferta')->findOferta($ciudad, $slug);
        $relacionadas = $em->getRepository('AppBundle:Oferta') ->findRelacionadas($ciudad);
        return $this->render('oferta/detalle.html.twig', array(
            'oferta' => $oferta,
            'relacionadas' => $relacionadas
        ));
    }
}
