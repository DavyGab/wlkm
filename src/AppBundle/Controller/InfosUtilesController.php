<?php

namespace AppBundle\Controller;

use AppBundle\Entity\InfosUtiles;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Infosutile controller.
 */
class InfosUtilesController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $infosUtiles = $em->getRepository('AppBundle:InfosUtiles')->findAllWithStatus();

        return $this->render('AppBundle:InfosUtiles:index.html.twig', array(
            'infosUtiles' => $infosUtiles,
        ));
    }

    public function newAction(Request $request)
    {
        $infosUtile = new InfosUtiles();
        $form = $this->createForm('AppBundle\Form\InfosUtilesType', $infosUtile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($infosUtile);
            $em->flush();

            return $this->redirectToRoute('infosutiles_edit', array('id' => $infosUtile->getId()));
        }

        return $this->render('AppBundle:InfosUtiles:form.html.twig', array(
            'infosUtile' => $infosUtile,
            'form' => $form->createView(),
            'action' => 'new'
        ));
    }

    public function editAction(Request $request, InfosUtiles $infosUtile)
    {
        $deleteForm = $this->createDeleteForm($infosUtile);
        $editForm = $this->createForm('AppBundle\Form\InfosUtilesType', $infosUtile);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash(
                'notice',
                'Les modifications ont bien été enregistrées.'
            );
        }

        return $this->render('AppBundle:InfosUtiles:form.html.twig', array(
            'infosUtile' => $infosUtile,
            'form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'action' => 'edit'
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
