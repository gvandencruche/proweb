<?php

namespace App\Controller\Admin;

use App\Entity\Parametre;
use App\Entity\Images;
use App\Form\ParametreType;
use App\Repository\ParametreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/administration/parametre")
 */
class ParametreController extends AbstractController
{
    /**
     * @Route("/", name="parametre_index", methods={"GET"})
     */
    public function index(ParametreRepository $parametreRepository): Response
    {
        
        return $this->render('admin/parametre/index.html.twig', [
            'parametres' => $parametreRepository->findAll(),
            'parametre' => $parametreRepository->findOneBy(array('titre' => $_SERVER['APP_SITE'])),
        ]);
    }

    /**
     * @Route("/new", name="parametre_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $parametre = new Parametre();
        $form = $this->createForm(ParametreType::class, $parametre);
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
                $parametre->setLogo($new);
                
            }

            

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($parametre);
            $entityManager->flush();

            return $this->redirectToRoute('parametre_index');
        }

        return $this->render('admin/parametre/new.html.twig', [
            'parametre' => $parametre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="parametre_show", methods={"GET"})
     */
    public function show(Parametre $parametre): Response
    {
        return $this->render('admin/parametre/show.html.twig', [
            'parametre' => $parametre,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="parametre_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Parametre $parametre): Response
    {
        $form = $this->createForm(ParametreType::class, $parametre);
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
                $parametre->setLogo($new);
                
            }
            $em->persist($parametre);
            $em->flush();
            return $this->redirectToRoute('parametre_index');
        }

        return $this->render('admin/parametre/edit.html.twig', [
            'parametre' => $parametre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="parametre_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Parametre $parametre): Response
    {
        if ($this->isCsrfTokenValid('delete'.$parametre->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($parametre);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin/parametre_index');
    }
}
