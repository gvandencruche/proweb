<?php

namespace App\Controller\Admin;

use App\Entity\Reference;
use App\Form\ReferenceType;
use App\Entity\Images;
use App\Repository\ParametreRepository;
use App\Repository\ReferenceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/reference")
 */
class ReferenceController extends AbstractController
{
    /**
     * @Route("/", name="reference_index", methods={"GET"})
     */
    public function index(ReferenceRepository $referenceRepository, ParametreRepository $parametreRepository): Response
    {
        return $this->render('admin/reference/index.html.twig', [
            'references' => $referenceRepository->findAll(),
            'parametre' => $parametreRepository->findSite($_SERVER['APP_SITE']), 
        ]);
    }

    /**
     * @Route("/new", name="reference_new", methods={"GET","POST"})
     */
    public function new(Request $request, ParametreRepository $parametreRepository): Response
    {
        $reference = new Reference();
        $form = $this->createForm(ReferenceType::class, $reference);
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
                $em->persist($new);
                $reference->setLogo($new);
                
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($reference);
            $entityManager->flush();

            return $this->redirectToRoute('reference_index');
        }

        return $this->render('admin/reference/new.html.twig', [
            'reference' => $reference,
            'form' => $form->createView(),
            'parametre' => $parametreRepository->findSite($_SERVER['APP_SITE']), 
        ]);
    }

    /**
     * @Route("/{id}", name="reference_show", methods={"GET"})
     */
    public function show(Reference $reference): Response
    {
        return $this->render('reference/show.html.twig', [
            'reference' => $reference,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="reference_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Reference $reference, ParametreRepository $parametreRepository): Response
    {
        $form = $this->createForm(ReferenceType::class, $reference);
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
                $em->persist($new);
                $reference->setLogo($new);
                
            }
            $em->persist($reference);
            $em->flush();

            return $this->redirectToRoute('reference_index');
        }

        return $this->render('admin/reference/edit.html.twig', [
            'reference' => $reference,
            'form' => $form->createView(),
            'parametre' => $parametreRepository->findSite($_SERVER['APP_SITE']), 
        ]);
    }

    /**
     * @Route("/{id}", name="reference_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Reference $reference): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reference->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($reference);
            $entityManager->flush();
        }

        return $this->redirectToRoute('reference_index');
    }
}
