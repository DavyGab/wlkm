<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ImagesAnnuaire;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Imagesannuaire controller.
 *
 * @Route("imagesannuaire")
 */
class ImagesAnnuaireController extends Controller
{
    /**
     * Lists all imagesAnnuaire entities.
     *
     * @Route("/", name="imagesannuaire_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $imagesAnnuaires = $em->getRepository('AppBundle:ImagesAnnuaire')->findAll();

        return $this->render('imagesannuaire/index.html.twig', array(
            'imagesAnnuaires' => $imagesAnnuaires,
        ));
    }

    /**
     * Creates a new imagesAnnuaire entity.
     *
     * @Route("/new", name="imagesannuaire_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $imagesAnnuaire = new Imagesannuaire();
        $form = $this->createForm('AppBundle\Form\ImagesAnnuaireType', $imagesAnnuaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($imagesAnnuaire);
            $em->flush();

            return $this->redirectToRoute('imagesannuaire_show', array('id' => $imagesAnnuaire->getId()));
        }

        return $this->render('imagesannuaire/new.html.twig', array(
            'imagesAnnuaire' => $imagesAnnuaire,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a imagesAnnuaire entity.
     *
     * @Route("/{id}", name="imagesannuaire_show")
     * @Method("GET")
     */
    public function showAction(ImagesAnnuaire $imagesAnnuaire)
    {
        $deleteForm = $this->createDeleteForm($imagesAnnuaire);

        return $this->render('imagesannuaire/show.html.twig', array(
            'imagesAnnuaire' => $imagesAnnuaire,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing imagesAnnuaire entity.
     *
     * @Route("/{id}/edit", name="imagesannuaire_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ImagesAnnuaire $imagesAnnuaire)
    {
        $deleteForm = $this->createDeleteForm($imagesAnnuaire);
        $editForm = $this->createForm('AppBundle\Form\ImagesAnnuaireType', $imagesAnnuaire);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('imagesannuaire_edit', array('id' => $imagesAnnuaire->getId()));
        }

        return $this->render('imagesannuaire/edit.html.twig', array(
            'imagesAnnuaire' => $imagesAnnuaire,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a imagesAnnuaire entity.
     *
     * @Route("/{id}", name="imagesannuaire_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ImagesAnnuaire $imagesAnnuaire)
    {
        $form = $this->createDeleteForm($imagesAnnuaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($imagesAnnuaire);
            $em->flush();
        }

        return $this->redirectToRoute('imagesannuaire_index');
    }

    /**
     * Creates a form to delete a imagesAnnuaire entity.
     *
     * @param ImagesAnnuaire $imagesAnnuaire The imagesAnnuaire entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ImagesAnnuaire $imagesAnnuaire)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('imagesannuaire_delete', array('id' => $imagesAnnuaire->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
