<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Borne;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Home controller.
 */
class HomeController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $bornes = $em->getRepository('AppBundle:Borne')->findAll();
        return $this->render('AppBundle:Home:index.html.twig', array(
            'bornes' => $bornes,
        ));
    }
    
}
