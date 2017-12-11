<?php

namespace AppBundle\Controller;

use AppBundle\Entity\CategoriesAnnonce;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Categoriesannonce controller.
 *
 * @Route("categoriesannonce")
 */
class CategoriesAnnonceController extends Controller
{
    /**
     * Lists all categoriesAnnonce entities.
     *
     * @Route("/", name="categoriesannonce_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $categoriesAnnonces = $em->getRepository('AppBundle:CategoriesAnnonce')->findAll();

        return $this->render('categoriesannonce/index.html.twig', array(
            'categoriesAnnonces' => $categoriesAnnonces,
        ));
    }

    /**
     * Creates a new categoriesAnnonce entity.
     *
     * @Route("/new", name="categoriesannonce_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $categoriesAnnonce = new Categoriesannonce();
        $form = $this->createForm('AppBundle\Form\CategoriesAnnonceType', $categoriesAnnonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($categoriesAnnonce);
            $em->flush();

            return $this->redirectToRoute('categoriesannonce_show', array('id' => $categoriesAnnonce->getId()));
        }

        return $this->render('categoriesannonce/new.html.twig', array(
            'categoriesAnnonce' => $categoriesAnnonce,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a categoriesAnnonce entity.
     *
     * @Route("/{id}", name="categoriesannonce_show")
     * @Method("GET")
     */
    public function showAction(CategoriesAnnonce $categoriesAnnonce)
    {
        $deleteForm = $this->createDeleteForm($categoriesAnnonce);

        return $this->render('categoriesannonce/show.html.twig', array(
            'categoriesAnnonce' => $categoriesAnnonce,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing categoriesAnnonce entity.
     *
     * @Route("/{id}/edit", name="categoriesannonce_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CategoriesAnnonce $categoriesAnnonce)
    {
        $deleteForm = $this->createDeleteForm($categoriesAnnonce);
        $editForm = $this->createForm('AppBundle\Form\CategoriesAnnonceType', $categoriesAnnonce);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('categoriesannonce_edit', array('id' => $categoriesAnnonce->getId()));
        }

        return $this->render('categoriesannonce/edit.html.twig', array(
            'categoriesAnnonce' => $categoriesAnnonce,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a categoriesAnnonce entity.
     *
     * @Route("/{id}", name="categoriesannonce_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, CategoriesAnnonce $categoriesAnnonce)
    {
        $form = $this->createDeleteForm($categoriesAnnonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($categoriesAnnonce);
            $em->flush();
        }

        return $this->redirectToRoute('categoriesannonce_index');
    }

    /**
     * Creates a form to delete a categoriesAnnonce entity.
     *
     * @param CategoriesAnnonce $categoriesAnnonce The categoriesAnnonce entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CategoriesAnnonce $categoriesAnnonce)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('categoriesannonce_delete', array('id' => $categoriesAnnonce->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
