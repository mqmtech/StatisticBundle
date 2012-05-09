<?php

namespace MQM\StatisticBundle\Model;

use MQM\StatisticBundle\Model\StatisticInterface;

interface StatisticFactoryInterface
{    
    /**
     * @return StatisticInterface
     */
    public function createStatistic();

    /**
     * @return string 
     */
    public function getStatisticClass();
}