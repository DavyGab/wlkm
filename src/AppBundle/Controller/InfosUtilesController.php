<?php

namespace AppBundle\Controller;

use AppBundle\Entity\InfosUtiles;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Infosutile controller.
 */
class InfosUtilesController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $infosUtiles = $em->getRepository('AppBundle:InfosUtiles')->findAll();

        return $this->render('infosutiles/index.html.twig', array(
            'infosUtiles' => $infosUtiles,
        ));
    }

    public function newAction(Request $request)
    {
        $infosUtile = new Infosutile();
        $form = $this->createForm('AppBundle\Form\InfosUtilesType', $infosUtile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($infosUtile);
            $em->flush();

            return $this->redirectToRoute('infosutiles_show', array('id' => $infosUtile->getId()));
        }

        return $this->render('infosutiles/new.html.twig', array(
            'infosUtile' => $infosUtile,
            'form' => $form->createView(),
        ));
    }

    public function showAction(InfosUtiles $infosUtile)
    {
        $deleteForm = $this->createDeleteForm($infosUtile);

        return $this->render('infosutiles/show.html.twig', array(
            'infosUtile' => $infosUtile,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function editAction(Request $request, InfosUtiles $infosUtile)
    {
        $deleteForm = $this->createDeleteForm($infosUtile);
        $editForm = $this->createForm('AppBundle\Form\InfosUtilesType', $infosUtile);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('infosutiles_edit', array('id' => $infosUtile->getId()));
        }

        return $this->render('infosutiles/edit.html.twig', array(
            'infosUtile' => $infosUtile,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function deleteAction(Request $request, InfosUtiles $infosUtile)
    {
        $form = $this->createDeleteForm($infosUtile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($infosUtile);
            $em->flush();
        }

        return $this->redirectToRoute('infosutiles_index');
    }

    /**
     * Creates a form to delete a infosUtile entity.
     *
     * @param InfosUtiles $infosUtile The infosUtile entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(InfosUtiles $infosUtile)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('infosutiles_delete', array('id' => $infosUtile->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
