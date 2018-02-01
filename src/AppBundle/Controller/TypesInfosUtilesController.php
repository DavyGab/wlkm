<?php

namespace AppBundle\Controller;

use AppBundle\Entity\TypesInfosUtiles;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


class TypesInfosUtilesController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $typesInfosUtiles = $em->getRepository('AppBundle:TypesInfosUtiles')->findAll();

        return $this->render('AppBundle:TypeInfosUtiles:index.html.twig', array(
            'typesInfosUtiles' => $typesInfosUtiles,
        ));
    }

    public function newAction(Request $request)
    {
        $typesInfosUtile = new TypesInfosUtiles();
        $form = $this->createForm('AppBundle\Form\TypesInfosUtilesType', $typesInfosUtile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($typesInfosUtile);
            $em->flush();

            return $this->redirectToRoute('type_infos_edit', array('id' => $typesInfosUtile->getId()));
        }

        return $this->render('AppBundle:TypeInfosUtiles:form.html.twig', array(
            'typesInfosUtile' => $typesInfosUtile,
            'form' => $form->createView(),
            'action' => 'new',
        ));
    }

    public function editAction(Request $request, TypesInfosUtiles $typesInfosUtile)
    {
        $deleteForm = $this->createDeleteForm($typesInfosUtile);
        $editForm = $this->createForm('AppBundle\Form\TypesInfosUtilesType', $typesInfosUtile);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash(
                'notice',
                'Les modifications ont bien été enregistrées.'
            );
        }

        return $this->render('AppBundle:TypeInfosUtiles:form.html.twig', array(
            'typesInfosUtile' => $typesInfosUtile,
            'form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'action' => 'edit',
        ));
    }

    public function deleteAction(Request $request, TypesInfosUtiles $typesInfosUtile)
    {
        $form = $this->createDeleteForm($typesInfosUtile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($typesInfosUtile);
            $em->flush();
        }

        return $this->redirectToRoute('type_infos_delete');
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
            ->setAction($this->generateUrl('type_infos_delete', array('id' => $typesInfosUtile->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
