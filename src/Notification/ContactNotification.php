<?php

namespace App\Notification;

use App\Entity\Contact;
use Exception;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;


class ContactNotification {

    private $mailer;
    private $templatedEmail;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
        
    }
    
    public function Notify(Contact $Contact, $template){
        try{

            
            $email = (new TemplatedEmail())
             ->from('hello@example.com')
                ->to($Contact->getEmail())
                //->cc('cc@example.com')
                //->bcc('bcc@example.com')
                //->replyTo('fabien@example.com')
                ->priority(Email::PRIORITY_HIGH)
                ->subject($Contact->getCategory())
                ->text('Sending emails is fun again!')
                ->embedFromPath('assets/images/logo.png', 'logo')
                ->htmlTemplate($template);

        $this->mailer->send($email);
            return true;
        }
        catch(Exception $e){
            dump($e->getMessage());exit;
            return false;
        }
    }
}

?>
