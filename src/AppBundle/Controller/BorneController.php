<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Borne;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\BorneType;

/**
 * Borne controller.
 */
class BorneController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $bornes = $em->getRepository('AppBundle:Borne')->findAll();

        return $this->render('AppBundle:Borne:index.html.twig', array(
            'bornes' => $bornes,
        ));
    }
    
    
    public function newAction(Request $request)
    {
        $borne = new Borne();
        $form = $this->createForm(BorneType::class, $borne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($borne);
            $em->flush();

            return $this->redirectToRoute('borne_show', array('id' => $borne->getId()));
        }

        return $this->render('AppBundle:Borne:form.html.twig', array(
            'borne' => $borne,
            'form' => $form->createView(),
            'action' => 'new'
        ));
    }
    
    
    public function showAction(Borne $borne)
    {
        $deleteForm = $this->createDeleteForm($borne);

        return $this->render('borne/show.html.twig', array(
            'borne' => $borne,
            'delete_form' => $deleteForm->createView(),
        ));
    }
    
    
    public function editAction(Request $request, Borne $borne)
    {
        $deleteForm = $this->createDeleteForm($borne);
        $editForm = $this->createForm('AppBundle\Form\BorneType', $borne);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('borne_edit', array('id' => $borne->getId()));
        }

        return $this->render('AppBundle:Borne:form.html.twig', array(
            'borne' => $borne,
            'form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'action' => 'edit'
        ));
    }

    
    public function deleteAction(Request $request, Borne $borne)
    {
        $form = $this->createDeleteForm($borne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($borne);
            $em->flush();
        }

        return $this->redirectToRoute('borne_index');
    }

    /**
     * Creates a form to delete a borne entity.
     *
     * @param Borne $borne The borne entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Borne $borne)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('borne_delete', array('id' => $borne->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
