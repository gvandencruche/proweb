<?php

namespace App\Controller\Admin;

use App\Entity\Rubrique;
use App\Form\RubriqueType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ParametreRepository;
use Symfony\Component\HttpFoundation\Request;

/**
* @Route("/administration", name="admin_")
*/
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ParametreRepository $parametreRepository): Response
    {
        return $this->render('admin/index.html.twig', [
            'parametre' => $parametreRepository->findOneBy(array('titre' => $_SERVER['APP_SITE'])),
        ]);
    }
     /**
     * @Route("/rubrique/ajout", name="rubriques_ajout")
     */
    public function ajoutRubrique(Request $request, ParametreRepository $parametreRepository): Response
    {
        $rubrique = new Rubrique;
        $form = $this->createForm(RubriqueType::class, $rubrique);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($rubrique);
            $entityManager->flush();

            return $this->redirectToRoute('admin_home');
        }

        return $this->render('admin/rubrique/ajout.html.twig', [
            'form' => $form->createView(),
            'parametre' => $parametreRepository->findOneBy(array('titre' => $_SERVER['APP_SITE'])),
        ]);
    }
}
