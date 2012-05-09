<?php

namespace MQM\StatisticBundle\Entity;

use MQM\StatisticBundle\Model\StatisticManagerInterface;
use MQM\StatisticBundle\Model\StatisticInterface;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\HttpFoundation\Request;
use MQM\PaginationBundle\Pagination\PaginationInterface;
use MQM\SortBundle\Sort\SortManagerInterface;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

class StatisticManager implements StatisticManagerInterface
{
    private $entityManager;
    private $classRegistry;   
    private $defaultStatisticName;
    private $securityContext;
    private $request;
    
    public function __construct(EntityManager $entityManager, $statistics = array(), $dimensions = array(), SecurityContextInterface $securityContext, Request $request = null)
    {
        $this->entityManager = $entityManager;
        $this->classRegistry = array_merge($statistics, $dimensions);
        $this->defaultStatisticName = current($statistics) ?: null;
        $this->securityContext = $securityContext;
        $this->request = $request;
    }

    /**
     * {@inheritDoc}
     */
    public function createDimension($name)
    {
        $className = $this->getClassFromAlias($name);
        
        return new $className();
    }

    /**
     * {@inheritDoc}
     */
    public function createStatistic($name) {
        $className = $this->getClassFromAlias($name);
        $statistic = new $className();

        $ip = $this->getUserIp();
        $statistic->setIp($ip);
        $user = $this->getUser();
        if (!is_string($user)) {
            $user = $user->getUsername();
        }
        $statistic->setUsername($user);

        return $statistic;
    }

    private function getUserIp() {
        return $this->request->getClientIp();
    }

    private function getUser () {
        $token = $this->securityContext->getToken();
        if ($token != null) {
            return $token->getUser();
        }

        return 'anon.';
    }
    
    private function getClassFromAlias($alias) {
        if (!isset($this->classRegistry[$alias])) {
            throw new \Exception('There is no className for the defined name in getClassFromAlias');
        }
        
        return $this->classRegistry[$alias];
    }
    
    /**
     * {@inheritDoc}
     */
    public function save(StatisticInterface $statistic, $andFlush = true)
    {
        $this->getEntityManager()->persist($statistic);
        if ($andFlush) {
            $this->getEntityManager()->flush();
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function delete(StatisticInterface $statistic, $andFlush = true)
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
    public function findOneBy(array $criteria, $name)
    {
        return $this->getRepository($name)->findOneBy($criteria);
    }
    
    /**
     * {@inheritDoc}
     */
    public function findAll($name)
    {
        return $this->getRepository($name)->findAll();
    }

    public function findMostViewedProducts(SortManagerInterface $sortManager = null, PaginationInterface $pagination = null)
    {
        $className = $this->getClassFromAlias('productViewStatistic');
        $qb = $this->entityManager->createQueryBuilder();
        $qb ->select('s')
            ->addSelect('count(p) as counter')
            ->from($className, ' s')
            ->join('s.product', 'p')
            ->addGroupBy('p');
        $query = $qb->getQuery();

        if ($sortManager) {
            $query = $sortManager->sortQuery($query, 'p');
        }
        if ($pagination) {
            $query = $pagination->paginateQuery($query);
        }

        return $query->getResult();
    }

    public function findMostSoldProducts(SortManagerInterface $sortManager = null, PaginationInterface $pagination = null)
    {
        $className = $this->getClassFromAlias('orderItemStatistic');
        $qb = $this->entityManager->createQueryBuilder();
        $qb ->select('s')
            ->addSelect('sum(s.quantity) as counter')
            ->from($className, ' s')
            ->join('s.product', 'p')
            ->addGroupBy('p');
        $query = $qb->getQuery();

        if ($sortManager) {
            $query = $sortManager->sortQuery($query, 'p');
        }
        if ($pagination) {
            $query = $pagination->paginateQuery($query);
        }

        return $query->getResult();
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
    protected function getRepository($name) {
        $className = $this->getClassFromAlias($name);

        return $this->entityManager->getRepository($className);
    }
}