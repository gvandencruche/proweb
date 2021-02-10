<?php

namespace App\Controller\Admin;

use App\Entity\TypeMedias;
use App\Form\TypeMediasType;
use App\Repository\TypeMediasRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/type/medias")
 */
class TypeMediasController extends AbstractController
{
    /**
     * @Route("/", name="type_medias_index", methods={"GET"})
     */
    public function index(TypeMediasRepository $typeMediasRepository): Response
    {
        return $this->render('admin\type_medias/index.html.twig', [
            'type_medias' => $typeMediasRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="type_medias_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $typeMedia = new TypeMedias();
        $form = $this->createForm(TypeMediasType::class, $typeMedia);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($typeMedia);
            $entityManager->flush();

            return $this->redirectToRoute('type_medias_index');
        }

        return $this->render('admin\type_medias/new.html.twig', [
            'type_media' => $typeMedia,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="type_medias_show", methods={"GET"})
     */
    public function show(TypeMedias $typeMedia): Response
    {
        return $this->render('admin\type_medias/show.html.twig', [
            'type_media' => $typeMedia,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="type_medias_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TypeMedias $typeMedia): Response
    {
        $form = $this->createForm(TypeMediasType::class, $typeMedia);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('type_medias_index');
        }

        return $this->render('admin\type_medias/edit.html.twig', [
            'type_media' => $typeMedia,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="type_medias_delete", methods={"DELETE"})
     */
    public function delete(Request $request, TypeMedias $typeMedia): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeMedia->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($typeMedia);
            $entityManager->flush();
        }

        return $this->redirectToRoute('type_medias_index');
    }
}
