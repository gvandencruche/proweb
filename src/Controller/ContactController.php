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

            return $this->render('contact/okenvoimail.html.twig', [
                'parametre' => $parametreRepository->findSite($_SERVER['APP_SITE']),
            ]);
        }

        return $this->render('contact/new.html.twig', [
            'contact' => $contact,
            'parametre' => $parametreRepository->findSite($_SERVER['APP_SITE']),
            'form' => $form->createView(),
        ]);
    }

    
}
