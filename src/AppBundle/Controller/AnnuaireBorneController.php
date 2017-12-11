<?php

namespace AppBundle\Controller;

use AppBundle\Entity\AnnuaireBorne;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Annuaireborne controller.
 *
 * @Route("annuaireborne")
 */
class AnnuaireBorneController extends Controller
{
    /**
     * Lists all annuaireBorne entities.
     *
     * @Route("/", name="annuaireborne_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $annuaireBornes = $em->getRepository('AppBundle:AnnuaireBorne')->findAll();

        return $this->render('annuaireborne/index.html.twig', array(
            'annuaireBornes' => $annuaireBornes,
        ));
    }

    /**
     * Creates a new annuaireBorne entity.
     *
     * @Route("/new", name="annuaireborne_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $annuaireBorne = new Annuaireborne();
        $form = $this->createForm('AppBundle\Form\AnnuaireBorneType', $annuaireBorne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($annuaireBorne);
            $em->flush();

            return $this->redirectToRoute('annuaireborne_show', array('id' => $annuaireBorne->getId()));
        }

        return $this->render('annuaireborne/new.html.twig', array(
            'annuaireBorne' => $annuaireBorne,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a annuaireBorne entity.
     *
     * @Route("/{id}", name="annuaireborne_show")
     * @Method("GET")
     */
    public function showAction(AnnuaireBorne $annuaireBorne)
    {
        $deleteForm = $this->createDeleteForm($annuaireBorne);

        return $this->render('annuaireborne/show.html.twig', array(
            'annuaireBorne' => $annuaireBorne,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing annuaireBorne entity.
     *
     * @Route("/{id}/edit", name="annuaireborne_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, AnnuaireBorne $annuaireBorne)
    {
        $deleteForm = $this->createDeleteForm($annuaireBorne);
        $editForm = $this->createForm('AppBundle\Form\AnnuaireBorneType', $annuaireBorne);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('annuaireborne_edit', array('id' => $annuaireBorne->getId()));
        }

        return $this->render('annuaireborne/edit.html.twig', array(
            'annuaireBorne' => $annuaireBorne,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a annuaireBorne entity.
     *
     * @Route("/{id}", name="annuaireborne_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, AnnuaireBorne $annuaireBorne)
    {
        $form = $this->createDeleteForm($annuaireBorne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($annuaireBorne);
            $em->flush();
        }

        return $this->redirectToRoute('annuaireborne_index');
    }

    /**
     * Creates a form to delete a annuaireBorne entity.
     *
     * @param AnnuaireBorne $annuaireBorne The annuaireBorne entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(AnnuaireBorne $annuaireBorne)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('annuaireborne_delete', array('id' => $annuaireBorne->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
