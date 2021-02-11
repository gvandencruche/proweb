<?php

namespace App\EventSubscriber;

use App\Notification\VisiteNotification;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;

class TwigEventSubscriber implements EventSubscriberInterface
{
    private $logger;
 
    public function __construct(VisiteNotification $logger)
    {
        $this->logger = $logger;
    }

    public function onControllerEvent(ControllerEvent $event)
    {
        $this->logger->visite();
        
    }

    public static function getSubscribedEvents()
    {
        
        
        return [
            ControllerEvent::class => 'onControllerEvent',
        ];
    }
}
