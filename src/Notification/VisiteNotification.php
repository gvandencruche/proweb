<?php

namespace App\Notification;

use Psr\Log\LoggerInterface;

class VisiteNotification {

    
    private $logger;
 
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
    
    public function visite()
    {
        $this->logger->info(date('Y-m-d H:i:s')." - ".$_SERVER['REMOTE_ADDR']." - ".$_SERVER['REQUEST_URI']);
    }
    
   
}

?>
