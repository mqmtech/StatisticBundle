<?php

namespace MQM\StatisticBundle\Entity;

use MQM\StatisticBundle\Model\StatisticFactoryInterface;

class StatisticFactory implements StatisticFactoryInterface
{    
    private $statisticClass;
    private $entryClass;
    
    public function __construct($statisticClass, $entryClass)
    {
        $this->statisticClass = $statisticClass;
        $this->entryClass = $entryClass;
    }
    
    /**
     * {@inheritDoc} 
     */
    public function createStatistic()
    {
        return new $this->statisticClass();
    }
    
    /**
     * {@inheritDoc} 
     */
    public function createEntry()
    {
        return new $this->entryClass();
    }
    
    /**
     * {@inheritDoc} 
     */
    public function getStatisticClass()
    {
        return $this->statisticClass;
    }
    
    /**
     * {@inheritDoc} 
     */
    public function getEntryClass()
    {
        return $this->entryClass;
    }
}