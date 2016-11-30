<?php

namespace MediaBundle\Controller;

use MediaBundle\Entity\Avis;
use MediaBundle\Entity\Musique;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Musique controller.
 *
 */
class MusiqueController extends Controller
{
    /**
     * Lists all musique entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

//        Si on ne reçoit rien du formulaire de recherche, on affiche tous les albums
        if (!array_key_exists("genre", $_REQUEST) or $_REQUEST['genre'] == "all") {
            $musiques = $em->getRepository('MediaBundle:Musique')->findAll();
        }
//        Sinon on affiche les albums du genre choisi
        else{
            $genre = $_REQUEST['genre'];
            $musiques = $em->getRepository('MediaBundle:Musique')->findByGenre($genre);
        }

        return $this->render('@Media/musique/index.html.twig', array(
            'musiques' => $musiques,
        ));
    }

    /**
     * Creates a new musique entity.
     *
     */
    public function newAction(Request $request)
    {
        $musique = new Musique();
        $form = $this->createForm('MediaBundle\Form\MusiqueType', $musique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($musique);
            $em->flush($musique);

            return $this->redirectToRoute('musique_index');
        }

        return $this->render('@Media/musique/new.html.twig', array(
            'musique' => $musique,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a musique entity.
     *
     */
    public function showAction(Musique $musique, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $avis = $em->getRepository('MediaBundle:Avis')->findBy(array('musiques' => $musique->getId()));

        $newAvis = new Avis();
        $form = $this->createForm('MediaBundle\Form\AvisType', $newAvis);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            if ($newAvis->getUser() == null){
                $newAvis->setUser('Anonyme');
            }
            $newAvis->setMusiques($musique);
            $em->persist($newAvis);
            $em->flush();

            return $this->redirectToRoute('musique_show', array('id' => $musique->getId()));
        }

        return $this->render('@Media/musique/show.html.twig', array(
            'avis' => $avis,
            'form' => $form->createView(),
            'musique' => $musique,
        ));
    }

    /**
     * Displays a form to edit an existing musique entity.
     *
     */
    public function editAction(Request $request, Musique $musique)
    {
        $editForm = $this->createForm('MediaBundle\Form\MusiqueType', $musique);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $musique->preUpload();
            $em->persist($musique);
            $em->flush();
            return $this->redirectToRoute('musique_index');
        }

        return $this->render('@Media/musique/edit.html.twig', array(
            'musique' => $musique,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Delete album.
     *
     */
    public function deleteAlbumAction($id){
        $em = $this->getDoctrine()->getManager();
        $album = $em->getRepository('MediaBundle:Musique')->findOneById($id);

        $em->remove($album);
        $em->flush();

        return $this->redirectToRoute('musique_index');
    }

    /**
     * Delete Avis.
     *
     */
    public function deleteAvisAction($id, $id_album){
        $em = $this->getDoctrine()->getManager();
        $avis = $em->getRepository('MediaBundle:Avis')->findOneById($id);

        $em->remove($avis);
        $em->flush();

        return $this->redirectToRoute('musique_show', array('id' => $id_album ));
    }
}
