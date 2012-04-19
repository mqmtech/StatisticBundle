<?php

namespace MQM\StatisticBundle\Model;

use MQM\StatisticBundle\Model\StatisticInterface;
use MQM\StatisticBundle\Model\StatisticEntryInterface;

interface StatisticFactoryInterface
{    
    /**
     * @return StatisticInterface
     */
    public function createStatistic();
    
    /**
     * @return StatisticEntryInterface
     */
    public function createEntry();
    
    /**
     * @return string 
     */
    public function getStatisticClass();
    
    /**
     * @return string 
     */
    public function getEntryClass();
}