<?php

namespace App\Notification;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\Form\Extension\HttpFoundation\HttpFoundationRequestHandler;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\Request;

class VisiteNotification {

    
    private $logger;
 
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
    
    public function visite()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $ip = $_SERVER['REMOTE_ADDR'];
        $date = date('Y-m-d H:i:s');
        $message = $date." - ".$ip." - ".$uri;
        $this->logger->info($message);
    }
}

?>
