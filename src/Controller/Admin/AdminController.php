<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ParametreRepository;

class AdminController extends AbstractController
{
    /**
     * @Route("/administration", name="admin_home")
     */
    public function index(ParametreRepository $parametreRepository): Response
    {
        return $this->render('admin/index.html.twig', [
            'parametre' => $parametreRepository->findOneBy(array('titre' => $_SERVER['APP_SITE'])),
        ]);
    }
}
