<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Annuaire;
use AppBundle\Entity\AnnuaireBorne;
use AppBundle\Entity\Borne;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Annuaire controller.
 */
class AnnuaireController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $annuaires = $em->getRepository('AppBundle:Annuaire')->findAll();

        return $this->render('AppBundle:Annuaire:index.html.twig', array(
            'annuaires' => $annuaires,
        ));
    }

    public function newAction(Request $request)
    {
        $annuaire = new Annuaire();
        $form = $this->createForm('AppBundle\Form\AnnuaireType', $annuaire);
        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();
        $bornes = $em->getRepository('AppBundle:Borne')->findAll();

        if ($form->isSubmitted() && $form->isValid()) {

            $bornesId = $request->get('bornes');
            foreach ($bornesId as $borneId) {
                $annuaireBorne = new AnnuaireBorne();
                $annuaireBorne->setBorne($borneId);
                $annuaireBorne->setAnnuaire($annuaire);
                $em->persist($annuaireBorne);
            }

            $em->persist($annuaire);
            $em->flush();

            return $this->redirectToRoute('annuaire_show', array('id' => $annuaire->getId()));
        }

        return $this->render('AppBundle:Annuaire:form.html.twig', array(
            'annuaire' => $annuaire,
            'bornes' => $bornes,
            'form' => $form->createView(),
            'action' => 'new'
        ));
    }

    public function showAction(Annuaire $annuaire)
    {
        $deleteForm = $this->createDeleteForm($annuaire);

        return $this->render('AppBundle:Annuaire:show.html.twig', array(
            'annuaire' => $annuaire,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function editAction(Request $request, Annuaire $annuaire)
    {
        $deleteForm = $this->createDeleteForm($annuaire);
        $editForm = $this->createForm('AppBundle\Form\AnnuaireType', $annuaire);
        $editForm->handleRequest($request);

        $em = $this->getDoctrine()->getManager();
        $bornes = $em->getRepository('AppBundle:Borne')->findAll();

        $annuaireWithBornes = $em->getRepository('AppBundle:Annuaire')->getAnnuaireWithBornes($annuaire->getId());
        $bornesSelected = array();

        foreach ($annuaireWithBornes->getAnnuaireBorne() as $annuaireBornesSelected) {
            $bornesSelected[$annuaireBornesSelected->getBorne()->getId()] = $annuaireBornesSelected;
        }

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('annuaire_edit', array('id' => $annuaire->getId()));
        }

        return $this->render('AppBundle:Annuaire:form.html.twig', array(
            'annuaire' => $annuaire,
            'bornes' => $bornes,
            'annuairesBornesSelected' => $bornesSelected,
            'form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'action' => 'edit'
        ));
    }

    public function deleteAction(Request $request, Annuaire $annuaire)
    {
        $form = $this->createDeleteForm($annuaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($annuaire);
            $em->flush();
        }

        return $this->redirectToRoute('annuaire_index');
    }

    /**
     * Creates a form to delete a annuaire entity.
     *
     * @param Annuaire $annuaire The annuaire entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Annuaire $annuaire)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('annuaire_delete', array('id' => $annuaire->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
