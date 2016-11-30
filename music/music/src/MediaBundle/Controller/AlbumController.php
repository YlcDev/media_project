<?php

namespace MediaBundle\Controller;

use MediaBundle\Entity\Album;
use MediaBundle\Entity\Commentaire;
use MediaBundle\Form\CommentaireType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Album controller.
 *
 */
class AlbumController extends Controller
{
    /**
     * Lists all album entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $albums = $em->getRepository('MediaBundle:Album')->findAll();

        return $this->render('MediaBundle:album:index.html.twig', array(
            'albums' => $albums,
        ));
    }

    /**
     * Creates a new album entity.
     *
     */
    public function newAction(Request $request)
    {
        $album = new Album();
        $form = $this->createForm('MediaBundle\Form\AlbumType', $album);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($album);
            $em->flush($album);

            return $this->redirectToRoute('album_index');
        }

        return $this->render('MediaBundle:album:new.html.twig', array(
            'album' => $album,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a album entity.
     *
     */
    public function showAction(Album $album, Request $request)
    {
        // delete album
        $deleteForm = $this->createDeleteForm($album);

        // recup les comm
        $em = $this->getDoctrine()->getManager();
        $commentaires = $em->getRepository('MediaBundle:Commentaire')->findAll();

        // creation comm et lien album
        $commentaire = new Commentaire();
        $commentaire->setAlbum($album);
        $newCom = $this->createForm(new CommentaireType(), $commentaire);
        $newCom->handleRequest($request);

        if ($newCom->isSubmitted() && $newCom->isValid()) {
            $cem = $this->getDoctrine()->getManager();
            $cem->persist($commentaire);
            $cem->flush();

            return $this->redirectToRoute('album_show', array('id' => $album->getId()));
        }



        return $this->render('MediaBundle:album:show.html.twig', array(
            'album' => $album,
            'newCom' => $newCom->createView(),
            'commentaires' => $commentaires,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing album entity.
     *
     */
    public function editAction(Request $request, Album $album)
    {
        $deleteForm = $this->createDeleteForm($album);
        $editForm = $this->createForm('MediaBundle\Form\AlbumType', $album);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('album_index');
        }

        return $this->render('MediaBundle:album:edit.html.twig', array(
            'album' => $album,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a album entity.
     *
     */
    public function deleteAction(Request $request, Album $album)
    {
        $form = $this->createDeleteForm($album);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($album);
            $em->flush($album);
        }

        return $this->redirectToRoute('album_index');
    }

    /**
     * Creates a form to delete a album entity.
     *
     * @param Album $album The album entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Album $album)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('album_delete', array('id' => $album->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
