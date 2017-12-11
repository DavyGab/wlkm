<?php

namespace AppBundle\Controller;

use AppBundle\Entity\CategoriesAnnuaire;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Categoriesannuaire controller.
 *
 * @Route("categoriesannuaire")
 */
class CategoriesAnnuaireController extends Controller
{
    /**
     * Lists all categoriesAnnuaire entities.
     *
     * @Route("/", name="categoriesannuaire_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $categoriesAnnuaires = $em->getRepository('AppBundle:CategoriesAnnuaire')->findAll();

        return $this->render('categoriesannuaire/index.html.twig', array(
            'categoriesAnnuaires' => $categoriesAnnuaires,
        ));
    }

    /**
     * Creates a new categoriesAnnuaire entity.
     *
     * @Route("/new", name="categoriesannuaire_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $categoriesAnnuaire = new Categoriesannuaire();
        $form = $this->createForm('AppBundle\Form\CategoriesAnnuaireType', $categoriesAnnuaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($categoriesAnnuaire);
            $em->flush();

            return $this->redirectToRoute('categoriesannuaire_show', array('id' => $categoriesAnnuaire->getId()));
        }

        return $this->render('categoriesannuaire/new.html.twig', array(
            'categoriesAnnuaire' => $categoriesAnnuaire,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a categoriesAnnuaire entity.
     *
     * @Route("/{id}", name="categoriesannuaire_show")
     * @Method("GET")
     */
    public function showAction(CategoriesAnnuaire $categoriesAnnuaire)
    {
        $deleteForm = $this->createDeleteForm($categoriesAnnuaire);

        return $this->render('categoriesannuaire/show.html.twig', array(
            'categoriesAnnuaire' => $categoriesAnnuaire,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing categoriesAnnuaire entity.
     *
     * @Route("/{id}/edit", name="categoriesannuaire_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CategoriesAnnuaire $categoriesAnnuaire)
    {
        $deleteForm = $this->createDeleteForm($categoriesAnnuaire);
        $editForm = $this->createForm('AppBundle\Form\CategoriesAnnuaireType', $categoriesAnnuaire);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('categoriesannuaire_edit', array('id' => $categoriesAnnuaire->getId()));
        }

        return $this->render('categoriesannuaire/edit.html.twig', array(
            'categoriesAnnuaire' => $categoriesAnnuaire,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a categoriesAnnuaire entity.
     *
     * @Route("/{id}", name="categoriesannuaire_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, CategoriesAnnuaire $categoriesAnnuaire)
    {
        $form = $this->createDeleteForm($categoriesAnnuaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($categoriesAnnuaire);
            $em->flush();
        }

        return $this->redirectToRoute('categoriesannuaire_index');
    }

    /**
     * Creates a form to delete a categoriesAnnuaire entity.
     *
     * @param CategoriesAnnuaire $categoriesAnnuaire The categoriesAnnuaire entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CategoriesAnnuaire $categoriesAnnuaire)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('categoriesannuaire_delete', array('id' => $categoriesAnnuaire->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
