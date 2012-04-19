<?php

namespace MQM\StatisticBundle\EventListener;

use MQM\StatisticBundle\Model\StatisticManagerInterface;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class StatisticListener
{
    private $statisticManager;
    
    public function __construct(StatisticManagerInterface $statisticManager)
    {
        $this->statisticManager = $statisticManager;
    }
 
    public function onKernelRequest(GetResponseEvent $event)
    {
        if ($event->getRequestType() !== HttpKernel::MASTER_REQUEST) {
            return;
        }
    }
}
