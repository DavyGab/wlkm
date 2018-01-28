<?php

namespace AppBundle\Controller;

use AppBundle\Entity\PetitesAnnonces;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class PetitesAnnoncesController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $petitesAnnonces = $em->getRepository('AppBundle:PetitesAnnonces')->findAllWithStatus();

        return $this->render('AppBundle:PetitesAnnonces:index.html.twig', array(
            'petitesAnnonces' => $petitesAnnonces,
        ));
    }

    public function newAction(Request $request)
    {
        $petitesAnnonce = new PetitesAnnonces();
        $form = $this->createForm('AppBundle\Form\PetitesAnnoncesType', $petitesAnnonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($petitesAnnonce);
            $em->flush();

            return $this->redirectToRoute('petitesannonces_edit', array('id' => $petitesAnnonce->getId()));
        }

        return $this->render('AppBundle:PetitesAnnonces:form.html.twig', array(
            'petitesAnnonce' => $petitesAnnonce,
            'form' => $form->createView(),
            'action' => 'new'
        ));
    }

    public function showAction(PetitesAnnonces $petitesAnnonce)
    {
        $deleteForm = $this->createDeleteForm($petitesAnnonce);

        return $this->render('AppBundle:PetitesAnnonces:form.html.twig', array(
            'petitesAnnonce' => $petitesAnnonce,
            'delete_form' => $deleteForm->createView(),
            'action' => 'edit'
        ));
    }

    public function editAction(Request $request, PetitesAnnonces $petitesAnnonce)
    {
        $deleteForm = $this->createDeleteForm($petitesAnnonce);
        $editForm = $this->createForm('AppBundle\Form\PetitesAnnoncesType', $petitesAnnonce);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

//            return $this->redirectToRoute('petitesannonces_edit', array('id' => $petitesAnnonce->getId()));
        }

        return $this->render('AppBundle:PetitesAnnonces:form.html.twig', array(
            'petitesAnnonce' => $petitesAnnonce,
            'form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'action' => 'edit'
        ));
    }

    public function deleteAction(Request $request, PetitesAnnonces $petitesAnnonce)
    {
        $form = $this->createDeleteForm($petitesAnnonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($petitesAnnonce);
            $em->flush();
        }

        return $this->redirectToRoute('petitesannonces_index');
    }

    /**
     * Creates a form to delete a petitesAnnonce entity.
     *
     * @param PetitesAnnonces $petitesAnnonce The petitesAnnonce entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(PetitesAnnonces $petitesAnnonce)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('petitesannonces_delete', array('id' => $petitesAnnonce->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
