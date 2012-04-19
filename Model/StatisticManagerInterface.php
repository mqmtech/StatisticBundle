<?php

namespace MQM\StatisticBundle\Model;

use MQM\StatisticBundle\Model\StatisticInterface;
use MQM\StatisticBundle\Model\StatisticEntryInterface;

interface StatisticManagerInterface
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
     *
     * @param StatisticEntryInterface $statistic
     * @param boolean $andFlush 
     */
    public function saveStatistic(StatisticInterface $statistic, $andFlush = true);
    
    /**
     *
     * @param StatisticEntryInterface $statistic
     * @param boolean $andFlush 
     */
    public function deleteStatistic(StatisticInterface $statistic, $andFlush = true);
    
    /**
     * @return StatisticManagerIngerface 
     */
    public function flush();
    
    /**
     * @param array $criteria
     * @return StatisticEntryInterface 
     */
    public function findStatisticBy(array $criteria);
    
    /**
     * @return array 
     */
    public function findStatistics();
    
    /**
     * @param string targetDomain
     * @param integer targetId
     * @return integer 
     */
    public function findEntriesCountByStatisticTargetDomainAndTargetId($targetDomain, $targetId);
}