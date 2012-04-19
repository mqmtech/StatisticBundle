<?php

namespace MQM\StatisticBundle\Model;

use MQM\StatisticBundle\Model\StatisticInterface;

interface StatisticEntryInterface
{
    /**
     * @return StatisticInterface 
     */
    public function getStatistic();

    /**
     * @param StatisticInterface $statistic 
     */
    public function setStatistic(StatisticInterface $statistic);
     
     /**
     * Get id
     *
     * @return integer 
     */
    public function getId();
    
    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     */
    public function setCreatedAt($createdAt);

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt();

    /**
     * Set modifiedAt
     *
     * @param \DateTime $modifiedAt
     */
    public function setModifiedAt($modifiedAt);

    /**
     * Get modifiedAt
     *
     * @return \DateTime 
     */
    public function getModifiedAt();
}