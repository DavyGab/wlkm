<?php

namespace AppBundle\Controller;

use AppBundle\Entity\PetitesAnnonces;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Petitesannonce controller.
 *
 * @Route("petitesannonces")
 */
class PetitesAnnoncesController extends Controller
{
    /**
     * Lists all petitesAnnonce entities.
     *
     * @Route("/", name="petitesannonces_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $petitesAnnonces = $em->getRepository('AppBundle:PetitesAnnonces')->findAll();

        return $this->render('petitesannonces/index.html.twig', array(
            'petitesAnnonces' => $petitesAnnonces,
        ));
    }

    /**
     * Creates a new petitesAnnonce entity.
     *
     * @Route("/new", name="petitesannonces_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $petitesAnnonce = new Petitesannonce();
        $form = $this->createForm('AppBundle\Form\PetitesAnnoncesType', $petitesAnnonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($petitesAnnonce);
            $em->flush();

            return $this->redirectToRoute('petitesannonces_show', array('id' => $petitesAnnonce->getId()));
        }

        return $this->render('petitesannonces/new.html.twig', array(
            'petitesAnnonce' => $petitesAnnonce,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a petitesAnnonce entity.
     *
     * @Route("/{id}", name="petitesannonces_show")
     * @Method("GET")
     */
    public function showAction(PetitesAnnonces $petitesAnnonce)
    {
        $deleteForm = $this->createDeleteForm($petitesAnnonce);

        return $this->render('petitesannonces/show.html.twig', array(
            'petitesAnnonce' => $petitesAnnonce,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing petitesAnnonce entity.
     *
     * @Route("/{id}/edit", name="petitesannonces_edit")
     * @Method({"GET", "POST"})
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

        return $this->render('petitesannonces/edit.html.twig', array(
            'petitesAnnonce' => $petitesAnnonce,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a petitesAnnonce entity.
     *
     * @Route("/{id}", name="petitesannonces_delete")
     * @Method("DELETE")
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
