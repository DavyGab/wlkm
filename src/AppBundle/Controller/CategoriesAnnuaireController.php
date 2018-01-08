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
            'categoriesAnnuaires' => $categoriesAnnuaires,
        ));
    }
    
    public function newAction(Request $request)
    {
        $categoriesAnnuaire = new Categoriesannuaire();
        $form = $this->createForm('AppBundle\Form\CategoriesAnnuaireType', $categoriesAnnuaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($categoriesAnnuaire);
            $em->flush();

            return $this->redirectToRoute('categorie_annuaire_edit', array('id' => $categoriesAnnuaire->getId()));
        }

        return $this->render('categoriesannuaire/new.html.twig', array(
            'categoriesAnnuaire' => $categoriesAnnuaire,
            'form' => $form->createView(),
            'action' => 'new'
        ));
    }
    
    public function showAction(CategoriesAnnuaire $categoriesAnnuaire)
    {
        $deleteForm = $this->createDeleteForm($categoriesAnnuaire);

        return $this->render('AppBundle:CategoriesAnnuaire:form.html.twig', array(
            'categoriesAnnuaire' => $categoriesAnnuaire,
            'delete_form' => $deleteForm->createView(),
        ));
    }
    
    public function editAction(Request $request, CategoriesAnnuaire $categoriesAnnuaire)
    {
        $deleteForm = $this->createDeleteForm($categoriesAnnuaire);
        $editForm = $this->createForm('AppBundle\Form\CategoriesAnnuaireType', $categoriesAnnuaire);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('categorie_annuaire_delete', array('id' => $categoriesAnnuaire->getId()));
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

    /**
     * Image uploadé en ajax
     */
    public function uploadImageAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $image = new Image();
        $media = $request->files->get('file');

        $image->setFile($media);
        $image->setPath($media->getPathName());
        $image->preUpload();
        $image->upload();

        //infos sur le document envoyé
//        var_dump($request->files->get('file'));die;
        return new JsonResponse(
            array(
                'success' => true,
                'path' => $image->getPath()
            )
        );
    }
}
