<?php

namespace App\Controller;

use App\Entity\Annonce;
use App\Entity\Parametre;
use App\Form\AnnonceType;
use App\Repository\ParametreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
* @Route("/user", name="user_")
*/
class UserController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ParametreRepository $parametreRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
            'parametre' => $parametreRepository->findOneBy(array('titre' => $_SERVER['APP_SITE'])),
        ]);
    }

    /**
     * @Route("/annonces/ajout", name="annonces_ajout")
     */
    public function ajoutAnnonce(Request $request, ParametreRepository $parametreRepository): Response
    {
        $annonce = new Annonce;
        $form = $this->createForm(AnnonceType::class, $annonce);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $annonce->setUser($this->getUser());
            $annonce->setActive(false);
            

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($annonce);
            $entityManager->flush();

            return $this->redirectToRoute('user_home');
        }

        return $this->render('user/annonces/ajout.html.twig', [
            'form' => $form->createView(),
            'parametre' => $parametreRepository->findOneBy(array('titre' => $_SERVER['APP_SITE'])),
        ]);
    }
}
