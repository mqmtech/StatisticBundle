<?php

namespace MQM\StatisticBundle\Entity;

use MQM\StatisticBundle\Model\StatisticFactoryInterface;

class StatisticFactory implements StatisticFactoryInterface
{    
    private $statisticClass;

    public function __construct($statisticClass, $entryClass = null)
    {
        $this->statisticClass = $statisticClass;
    }
    
    /**
     * {@inheritDoc} 
     */
    public function createStatistic($name = null)
    {
        return new $this->statisticClass();
    }
    /**
     * {@inheritDoc} 
     */
    public function getStatisticClass()
    {
        return $this->statisticClass;
    }
}