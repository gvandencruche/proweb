<?php

namespace App\Notification;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\Request;

class VisiteNotification {

    
    private $logger;
    private $request;
    private $router;

    public function __construct(LoggerInterface $logger, Request $request, RouterInterface $router)
    {
        $this->logger = $logger;
        $this->request = $request;
        $this->router = $router;
        
    }
    
    public function visite()
    {
        $currentRoute = $this->request->attributes->get('_route');
   
        $ip = $_SERVER['REMOTE_ADDR'];
        $date = date('Y-m-d H:i:s');
        //$this->logger->log("ici");
    }
}

?>
