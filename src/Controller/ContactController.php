<?php

namespace App\Controller;

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


class ContactController extends AbstractController
{
    

    /**
     * @Route("/index", name="contact_index", methods={"GET"})
     */
    public function index(ContactRepository $contactRepository, ParametreRepository $parametreRepository): Response
    {
        return $this->render('contact/index.html.twig', [
            'contacts' => $contactRepository->findAll(),
            'parametre' => $parametreRepository->findSite($_SERVER['APP_SITE']),
        ]);
    }

    /**
     * @Route("/prise-de-contact", name="contact_new", methods={"GET","POST"})
     */
    public function new(Request $request, ContactNotification $notification, ParametreRepository $parametreRepository): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
        
            $template = "mail/contact_email.html.twig";
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contact);
            $entityManager->flush();
            $notification->notify($contact, $template);

            //return $this->redirectToRoute('contact_index');
        }

        return $this->render('contact/new.html.twig', [
            'contact' => $contact,
            'parametre' => $parametreRepository->findSite($_SERVER['APP_SITE']),
            'form' => $form->createView(),
        ]);
    }

     /**
     * @Route("/showemail", name="contact_show_email", methods={"GET"})
     */
    public function showemail(ContactRepository $contactRepository): Response
    {
        $contact=$contactRepository->findLast();
       
        return $this->render('mail/contact_email.html.twig', [
            'contact' => $contact[0],
        ]);
    }
    
    /**
     * @Route("/{id}/edit", name="contact_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Contact $contact): Response
    {
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('contact_index');
        }

        return $this->render('contact/edit.html.twig', [
            'contact' => $contact,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="contact_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Contact $contact): Response
    {
        if ($this->isCsrfTokenValid('delete'.$contact->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($contact);
            $entityManager->flush();
        }

        return $this->redirectToRoute('contact_index');
    }
}
