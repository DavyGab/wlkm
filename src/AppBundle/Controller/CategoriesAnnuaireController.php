<?php

namespace AppBundle\Controller;

use AppBundle\Entity\CategoriesAnnuaire;
use AppBundle\Entity\Image;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Categoriesannuaire controller.
 *
 * @Route("categoriesannuaire")
 */
class CategoriesAnnuaireController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $categoriesAnnuaires = $em->getRepository('AppBundle:CategoriesAnnuaire')->findAll();

        return $this->render('AppBundle:CategoriesAnnuaire:index.html.twig', array(
            'categories' => $categoriesAnnuaires,
        ));
    }
    
    public function newAction(Request $request)
    {
        $categoriesAnnuaire = new CategoriesAnnuaire();
        $form = $this->createForm('AppBundle\Form\CategoriesAnnuaireType', $categoriesAnnuaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($categoriesAnnuaire);
            $em->flush();

            return $this->redirectToRoute('categorie_annuaire_edit', array('id' => $categoriesAnnuaire->getId()));
        }

        return $this->render('AppBundle:CategoriesAnnuaire:form.html.twig', array(
            'categoriesAnnuaire' => $categoriesAnnuaire,
            'form' => $form->createView(),
            'action' => 'new'
        ));
    }

    public function editAction(Request $request, CategoriesAnnuaire $categoriesAnnuaire)
    {
        $deleteForm = $this->createDeleteForm($categoriesAnnuaire);
        $editForm = $this->createForm('AppBundle\Form\CategoriesAnnuaireType', $categoriesAnnuaire);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
        }

        return $this->render('AppBundle:CategoriesAnnuaire:form.html.twig', array(
            'categoriesAnnuaire' => $categoriesAnnuaire,
            'form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'action' => 'edit'
        ));
    }

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
            ->setAction($this->generateUrl('categorie_annuaire_delete', array('id' => $categoriesAnnuaire->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
