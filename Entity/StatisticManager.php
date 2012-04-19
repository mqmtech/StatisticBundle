<?php

namespace MQM\StatisticBundle\Entity;

use MQM\StatisticBundle\Model\StatisticManagerInterface;
use MQM\StatisticBundle\Model\StatisticFactoryInterface;
use MQM\StatisticBundle\Model\StatisticInterface;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

class StatisticManager implements StatisticManagerInterface
{
    private $factory;
    private $entityManager;
    private $repository;
    
    public function __construct(EntityManager $entityManager, StatisticFactoryInterface $factory)
    {
        $this->entityManager = $entityManager;
        $this->factory = $factory;
        $statisticClass = $factory->getStatisticClass();
        $this->repository = $entityManager->getRepository($statisticClass);   
    }
    
    /**
     * {@inheritDoc}
     */
    public function createEntry()
    {
        return $this->getCartFactory()->createEntry();     
    }
    
    /**
     * {@inheritDoc}
     */
    public function createStatistic() {
        return $this->getCartFactory()->createStatistic();
    }
    
    /**
     * {@inheritDoc}
     */
    public function saveStatistic(StatisticInterface $statistic, $andFlush = true)
    {
        $this->getEntityManager()->persist($statistic);
        if ($andFlush) {
            $this->getEntityManager()->flush();
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function deleteStatistic(StatisticInterface $statistic, $andFlush = true)
    {
        $this->getEntityManager()->remove($statistic);
        if ($andFlush) {
            $this->getEntityManager()->flush();
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function flush()
    {
        $this->getEntityManager()->flush();
    }
    
    /**
     * {@inheritDoc}
     */
    public function findEntriesCountByStatisticTargetDomainAndTargetId($targetDomain, $targetId)
    {
        $this->getRepository()->findEntriesCountByStatisticTargetDomainAndTargetId($targetDomain, $targetId);
    }
    
    /**
     * {@inheritDoc}
     */
    public function findStatisticBy(array $criteria)
    {
        return $this->getRepository()->findOneBy($criteria);
    }
    
    /**
     * {@inheritDoc}
     */
    public function findStatistics()
    {
        return $this->getRepository()->findAll();
    }
    
    /**
     *
     * @return StatisticFactoryInterface
     */
    protected function getFactory() {
        return $this->factory;
    }    
    
    /**
     *
     * @return EntityManager
     */
    protected function getEntityManager() {
        return $this->entityManager;
    }
    
    /**
     *
     * @return EntityRepository
     */
    protected function getrepository() {
        return $this->repository;
    }
}