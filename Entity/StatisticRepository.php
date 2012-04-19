<?php

namespace MQM\StatisticBundle\Entity;

use Doctrine\ORM\EntityRepository;

class StatisticRepository extends EntityRepository{
    
    public function findEntriesCountByStatisticTargetDomainAndTargetId($targetDomain, $targetId)
    {
        $em = $this->getEntityManager();
        
        $q = $em->createQuery("SELECT count(e) from MQMStatisticBundle:StatisticEntry e JOIN e.statistic s WHERE e.targetDomain = '". $targetDomain ."' AND e.targetId = '". $targetId ."' ORDER BY e.createdAt DESC");
        $entriesCount = $q->getSingleScalarResult();

        return $entriesCount;
    }
}