<?php

namespace App\Controller\Admin;

use App\Entity\Medias;
use App\Entity\Images;
use App\Form\MediasType;
use App\Repository\MediasRepository;
use App\Repository\ParametreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/medias")
 */
class MediasController extends AbstractController
{
    /**
     * @Route("/", name="medias_index", methods={"GET"})
     */
    public function index(MediasRepository $mediasRepository, ParametreRepository $parametreRepository): Response
    {
        return $this->render('admin/medias/index.html.twig', [
            'medias' => $mediasRepository->findAll(),
            'parametre' => $parametreRepository->findOneBy(array('titre' => $_SERVER['APP_SITE'])),
        ]);
    }


    /**
     * @Route("/new", name="medias_new", methods={"GET","POST"})
     */
    public function new(Request $request, ParametreRepository $parametreRepository): Response
    {
        $media = new Medias();
        $media->setActive(false);
        $form = $this->createForm(MediasType::class, $media);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $images = $form->get('images')->getData();
            //On boucle sur les images
            $em = $this->getDoctrine()->getManager();
            foreach ($images as $image){
                //On genere un nom de fichier
                $fichier = md5(uniqid()).".".$image->guessExtension();
                //On copie le fichier
                $image->move($this->getParameter('app_images_directorie'), $fichier);
                //On stocke l'image
                $new = new Images;
                $new->setName($fichier);
                $new->setActive(false);
                $media->addImage($new);
            }
       
            $em->persist($media);
            $em->flush();
           

            return $this->redirectToRoute('medias_index');
        }

        return $this->render('admin/medias/new.html.twig', [
            'media' => $media,
            'form' => $form->createView(),
            'parametre' => $parametreRepository->findOneBy(array('titre' => $_SERVER['APP_SITE'])),
        ]);
    }

    /**
     * @Route("/{id}", name="medias_show", methods={"GET"})
     */
    public function show(Medias $media): Response
    {
        return $this->render('admin/medias/show.html.twig', [
            'media' => $media,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="medias_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Medias $media): Response
    {
        $form = $this->createForm(MediasType::class, $media);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('medias_index');
        }

        return $this->render('admin/medias/edit.html.twig', [
            'media' => $media,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="medias_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Medias $media): Response
    {
        if ($this->isCsrfTokenValid('delete'.$media->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($media);
            $entityManager->flush();
        }

        return $this->redirectToRoute('medias_index');
    }
}
