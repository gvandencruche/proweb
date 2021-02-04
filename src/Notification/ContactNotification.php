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
             ->from('no-reply@proweb-artois.fr')
                ->to($Contact->getEmail())
                //->cc('cc@example.com')
                //->bcc('bcc@example.com')
                //->replyTo('fabien@example.com')
                ->priority(Email::PRIORITY_HIGH)
                ->subject("Demande ".$Contact->getCategory()." du ".date_format($Contact->getDateEnvoi(),'d/m/Y'))
                ->context([
                    'contact' => $Contact,
                ])
                ->embedFromPath('assets/images/logo.png', 'logo')
                ->htmlTemplate($template);
   

            $a=$this->mailer->send($email);
            
            return true;
        }
        catch(Exception $e){
            dump($e->getMessage());exit;
            return false;
        }
    }
}

?>
