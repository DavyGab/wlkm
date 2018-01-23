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
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $categoriesAnnonces = $em->getRepository('AppBundle:CategoriesAnnonce')->findAll();

        return $this->render('AppBundle:CategoriesAnnonce:index.html.twig', array(
            'categories' => $categoriesAnnonces,
        ));
    }

    public function newAction(Request $request)
    {
        $categoriesAnnonce = new CategoriesAnnonce();
        $form = $this->createForm('AppBundle\Form\CategoriesAnnonceType', $categoriesAnnonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($categoriesAnnonce);
            $em->flush();

            return $this->redirectToRoute('categorie_annonce_show', array('id' => $categoriesAnnonce->getId()));
        }

        return $this->render('AppBundle:CategoriesAnnonce:form.html.twig', array(
            'categoriesAnnonce' => $categoriesAnnonce,
            'form' => $form->createView(),
            'action' => 'new'
        ));
    }
    
    public function showAction(CategoriesAnnonce $categoriesAnnonce)
    {
        $deleteForm = $this->createDeleteForm($categoriesAnnonce);

        return $this->render('AppBundle:CategoriesAnnonce:form.html.twig', array(
            'categoriesAnnonce' => $categoriesAnnonce,
            'form' => $deleteForm->createView(),
            'action' => 'edit'
        ));
    }
    
    public function editAction(Request $request, CategoriesAnnonce $categoriesAnnonce)
    {
        $deleteForm = $this->createDeleteForm($categoriesAnnonce);
        $editForm = $this->createForm('AppBundle\Form\CategoriesAnnonceType', $categoriesAnnonce);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('categorie_annonce_edit', array('id' => $categoriesAnnonce->getId()));
        }

        return $this->render('AppBundle:CategoriesAnnonce:form.html.twig', array(
            'categoriesAnnonce' => $categoriesAnnonce,
            'form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'action' => 'edit'
        ));
    }

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
            ->setAction($this->generateUrl('categorie_annonce_delete', array('id' => $categoriesAnnonce->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
