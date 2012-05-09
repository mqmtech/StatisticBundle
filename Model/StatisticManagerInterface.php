<?php

namespace MQM\StatisticBundle\Model;

use MQM\StatisticBundle\Model\StatisticInterface;
use MQM\StatisticBundle\Model\StatisticEntryInterface;

interface StatisticManagerInterface
{
    /**
     * @return StatisticInterface
     */
    public function createStatistic($name);

    /**
     * @return mixed
     */
    public function createDimension($name);
    
    /**
     *
     * @param StatisticEntryInterface $statistic
     * @param boolean $andFlush 
     */
    public function save(StatisticInterface $statistic, $andFlush = true);
    
    /**
     *
     * @param StatisticEntryInterface $statistic
     * @param boolean $andFlush 
     */
    public function delete(StatisticInterface $statistic, $andFlush = true);
    
    /**
     * @return StatisticManagerIngerface 
     */
    public function flush();
    
    /**
     * @param array $criteria
     * @return StatisticEntryInterface 
     */
    public function findOneBy(array $criteria, $name);
    
    /**
     * @return array 
     */
    public function findAll($name);
}