<?php

namespace AppBundle\Controller;

use AppBundle\Entity\TypesInfosUtiles;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Typesinfosutile controller.
 *
 * @Route("typesinfosutiles")
 */
class TypesInfosUtilesController extends Controller
{
    /**
     * Lists all typesInfosUtile entities.
     *
     * @Route("/", name="typesinfosutiles_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $typesInfosUtiles = $em->getRepository('AppBundle:TypesInfosUtiles')->findAll();

        return $this->render('typesinfosutiles/index.html.twig', array(
            'typesInfosUtiles' => $typesInfosUtiles,
        ));
    }

    /**
     * Creates a new typesInfosUtile entity.
     *
     * @Route("/new", name="typesinfosutiles_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $typesInfosUtile = new Typesinfosutile();
        $form = $this->createForm('AppBundle\Form\TypesInfosUtilesType', $typesInfosUtile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($typesInfosUtile);
            $em->flush();

            return $this->redirectToRoute('typesinfosutiles_show', array('id' => $typesInfosUtile->getId()));
        }

        return $this->render('typesinfosutiles/new.html.twig', array(
            'typesInfosUtile' => $typesInfosUtile,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a typesInfosUtile entity.
     *
     * @Route("/{id}", name="typesinfosutiles_show")
     * @Method("GET")
     */
    public function showAction(TypesInfosUtiles $typesInfosUtile)
    {
        $deleteForm = $this->createDeleteForm($typesInfosUtile);

        return $this->render('typesinfosutiles/show.html.twig', array(
            'typesInfosUtile' => $typesInfosUtile,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing typesInfosUtile entity.
     *
     * @Route("/{id}/edit", name="typesinfosutiles_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, TypesInfosUtiles $typesInfosUtile)
    {
        $deleteForm = $this->createDeleteForm($typesInfosUtile);
        $editForm = $this->createForm('AppBundle\Form\TypesInfosUtilesType', $typesInfosUtile);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('typesinfosutiles_edit', array('id' => $typesInfosUtile->getId()));
        }

        return $this->render('typesinfosutiles/edit.html.twig', array(
            'typesInfosUtile' => $typesInfosUtile,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a typesInfosUtile entity.
     *
     * @Route("/{id}", name="typesinfosutiles_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, TypesInfosUtiles $typesInfosUtile)
    {
        $form = $this->createDeleteForm($typesInfosUtile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($typesInfosUtile);
            $em->flush();
        }

        return $this->redirectToRoute('typesinfosutiles_index');
    }

    /**
     * Creates a form to delete a typesInfosUtile entity.
     *
     * @param TypesInfosUtiles $typesInfosUtile The typesInfosUtile entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(TypesInfosUtiles $typesInfosUtile)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('typesinfosutiles_delete', array('id' => $typesInfosUtile->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
