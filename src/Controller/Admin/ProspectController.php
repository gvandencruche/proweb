<?php

namespace App\Controller\Admin;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Notification\ContactNotification;
use App\Repository\ParametreRepository;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;
use DateTime;

/**
 * @Route("/administration/prospect")
 */
class ProspectController extends AbstractController
{
    
   

    /**
     * @Route("/", name="prospect_index", methods={"GET"})
     */
    public function index(ContactRepository $contactRepository, ParametreRepository $parametreRepository): Response
    {
        return $this->render('admin/prospect/index.html.twig', [
            'contacts' => $contactRepository->findAll(),
            'parametre' => $parametreRepository->findSite($_SERVER['APP_SITE']),
        ]);
    }

    
     /**
     * @Route("/showemail", name="prospect_show_email", methods={"GET"})
     */
    public function showemail(ContactRepository $contactRepository, ParametreRepository $parametreRepository): Response
    {
        $contact=$contactRepository->findLast();
       
        return $this->render('mail/prospect_email.html.twig', [
            'contact' => $contact[0],
            'parametre' => $parametreRepository->findSite($_SERVER['APP_SITE']),
        ]);
    }
    
    /**
     * @Route("/{id}/edit", name="prospect_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Contact $contact, ParametreRepository $parametreRepository): Response
    {
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('prospect_index');
        }

        return $this->render('admin/prospect/edit.html.twig', [
            'contact' => $contact,
            'form' => $form->createView(),
            'parametre' => $parametreRepository->findSite($_SERVER['APP_SITE']),
        ]);
    }

    /**
     * @Route("/{id}", name="prospect_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Contact $contact): Response
    {
        if ($this->isCsrfTokenValid('delete'.$contact->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($contact);
            $entityManager->flush();
        }

        return $this->redirectToRoute('prospect_index');
    }
}
