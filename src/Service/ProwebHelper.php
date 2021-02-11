<?php
namespace App\Service;

use Psr\Log\LoggerInterface;

class ProwebHelper
{

    private $logger;

    public function __construct(AdapterInterface $cache, MarkdownInterface $markdown, LoggerInterface $logger)
    {

        $this->logger = $logger;
    }

}
