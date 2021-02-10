<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


use App\Repository\ParametreRepository;
use App\Repository\ReferenceRepository;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index(ParametreRepository $parametreRepository, ReferenceRepository $referenceRepository): Response
    {
        if($this->getParameter('app_maintenance')){
            return $this->redirectToRoute('contact_new');
        }
       
        return $this->render('main/index.html.twig', [
            'parametre' => $parametreRepository->findSite($_SERVER['APP_SITE']), 
            'references' => $referenceRepository->findAll(), 
        ]);
    }
}
