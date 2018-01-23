<?php

namespace AppBundle\Controller;

use AppBundle\Entity\PetitesAnnonces;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class PetitesAnnoncesController extends Controller
{
    /**
     * Lists all petitesAnnonce entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $petitesAnnonces = $em->getRepository('AppBundle:PetitesAnnonces')->findAll();

        return $this->render('AppBundle:PetitesAnnonces:index.html.twig', array(
            'petitesAnnonces' => $petitesAnnonces,
        ));
    }

    /**
     * Creates a new petitesAnnonce entity.
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
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

    /**
     * Finds and displays a petitesAnnonce entity.
     * @param PetitesAnnonces $petitesAnnonce
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(PetitesAnnonces $petitesAnnonce)
    {
        $deleteForm = $this->createDeleteForm($petitesAnnonce);

        return $this->render('AppBundle:PetitesAnnonces:form.html.twig', array(
            'petitesAnnonce' => $petitesAnnonce,
            'delete_form' => $deleteForm->createView(),
            'action' => 'edit'
        ));
    }

    /**
     * Displays a form to edit an existing petitesAnnonce entity.
     * @param Request $request
     * @param PetitesAnnonces $petitesAnnonce
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, PetitesAnnonces $petitesAnnonce)
    {
        $deleteForm = $this->createDeleteForm($petitesAnnonce);
        $editForm = $this->createForm('AppBundle\Form\PetitesAnnoncesType', $petitesAnnonce);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('petitesannonces_edit', array('id' => $petitesAnnonce->getId()));
        }

        return $this->render('AppBundle:PetitesAnnonces:form.html.twig', array(
            'petitesAnnonce' => $petitesAnnonce,
            'form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'action' => 'edit'
        ));
    }

    /**
     * Deletes a petitesAnnonce entity.
     * @param Request $request
     * @param PetitesAnnonces $petitesAnnonce
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
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
