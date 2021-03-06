<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Annuaire;
use AppBundle\Entity\AnnuaireBorne;
use AppBundle\Entity\Borne;
use AppBundle\Entity\ImagesAnnuaire;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Annuaire controller.
 */
class AnnuaireController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $annuaires = $em->getRepository('AppBundle:Annuaire')->findAllWithStatus();

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

        if ($form->isSubmitted() && $form->isValid()) {

            /**
             * nregistrement des horaires
             */
            $horaires = array();
            $horairesNom = ['lun', 'mar', 'mer', 'jeu', 'ven', 'sam', 'dim'];
            foreach ($horairesNom as $horaireNom) {
                $horaires[$horaireNom] = $request->get($horaireNom, '');
            }
            $annuaire->setHoraires(json_encode($horaires));

            /**
             * Enregistrement des bornes
             */
            foreach($annuaire->getAnnuaireBorne() as $annuaireBorne) {
                $annuaireBorne->setAnnuaire($annuaire);
                if ($annuaireBorne->getBorne() == null) {
                    $annuaire->removeAnnuaireBorne($annuaireBorne);
                    $em->remove($annuaireBorne);
                }
            }

            /**
             * Enregistrement des images
             */
            $addImagesNames = $request->request->get('newFiles', '');
            $addImagesNames = explode(',', $addImagesNames);
            foreach ($addImagesNames as $imageName) {
                if ($imageName == '') { continue; }
                $annuaireImage = new ImagesAnnuaire();
                $annuaireImage->setUrl($imageName);
                $annuaire->addAnnuaireImage($annuaireImage);
            }
			$em->persist($annuaire);
            $em->flush();
			
            return $this->redirectToRoute('annuaire_edit', array('id' => $annuaire->getId()));
        }

        return $this->render('AppBundle:Annuaire:form.html.twig', array(
            'annuaire' => $annuaire,
//            'bornes' => $bornes,
            'form' => $form->createView(),
            'action' => 'new'
        ));
    }

    public function editAction(Request $request, Annuaire $annuaire)
    {
        $deleteForm = $this->createDeleteForm($annuaire);
        $editForm = $this->createForm('AppBundle\Form\AnnuaireType', $annuaire);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();

            /**
             * Enregistrement des horaires
             */
            $horaires = array();
            $horairesNom = ['lun', 'mar', 'mer', 'jeu', 'ven', 'sam', 'dim'];
            foreach ($horairesNom as $horaireNom) {
                $horaires[$horaireNom] = $request->get($horaireNom, '');
            }
            $annuaire->setHoraires(json_encode($horaires));

            /**
             * Enregistrement des bornes
             */
            foreach($annuaire->getAnnuaireBorne() as $annuaireBorne) {
                $annuaireBorne->setAnnuaire($annuaire);
                if ($annuaireBorne->getBorne() == null) {
                    $annuaire->removeAnnuaireBorne($annuaireBorne);
                    $em->remove($annuaireBorne);
                }
            }

            /**
             * Enregistrement des images
             */
            $addImagesNames = $request->request->get('newFiles', '');
            $addImagesNames = explode(',', $addImagesNames);
            foreach ($addImagesNames as $imageName) {
                if ($imageName == '') { continue; }
                $annuaireImage = new ImagesAnnuaire();
                $annuaireImage->setUrl($imageName);
                $annuaire->addAnnuaireImage($annuaireImage);
            }
            $removeImagesUrl = $request->request->get('deletedFiles', '');
            $removeImagesUrl = explode(',', $removeImagesUrl);
            foreach ($removeImagesUrl as $imageUrl) {
                if ($imageUrl == '') { continue; }
                if ($annuaireImage = $em->getRepository('AppBundle:ImagesAnnuaire')->findOneBy(array('url' => $imageUrl, 'annuaire' => $annuaire))) {
                    $annuaire->removeAnnuaireImage($annuaireImage);
                    $em->remove($annuaireImage);
                }
            }
            
            $em->flush();
            
            $request->getSession()->getFlashBag()->add(
                'notice',
                'Les modifications ont bien été enregistrées.'
            );
        }
        
        return $this->render('AppBundle:Annuaire:form.html.twig', array(
            'annuaire' => $annuaire,
            'imagesAnnuaire' => $annuaire->getAnnuaireImage(),
            'horaires' => json_decode($annuaire->getHoraires()),
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
