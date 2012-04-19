<?php

namespace MQM\StatisticBundle\Entity;

use MQM\StatisticBundle\Model\StatisticEntryInterface;
use MQM\StatisticBundle\Model\StatisticInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Table(name="mqm_stat_entry")
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks
 */
class StatisticEntry implements StatisticEntryInterface
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;    
    
    /**
     * @var \DateTime $createdAt
     *
     * @ORM\Column(name="createdAt", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var \DateTime $modifiedAt
     *
     * @ORM\Column(name="modifiedAt", type="datetime", nullable=true)
     */
    private $modifiedAt;

    /**
     * @ORM\ManyToOne(targetEntity="MQM\StatisticBundle\Entity\Statistic", inversedBy="entries", cascade={"persist"})
     * @ORM\JoinColumn(name="statisticId", referencedColumnName="id")
     *
     * @var StatisticInterface $statistic
     */
    private $statistic;
    
    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }
    
    public function __toString()
    {
        return '' . $this->getName();
    }
    
     /**
     * Invoked before the entity is updated.
     *
     * @ORM\PreUpdate
     */
    protected function preUpdate()
    {
        $this->updatedAt = new \DateTime();
    }    

    /**
     *
     * {@inheritDoc}
     */
    public function getStatistic()
    {
        return $this->statistic;
    }

    /**
     *
     * {@inheritDoc}
     */
    public function setStatistic(StatisticInterface $statistic)
    {
        $this->statistic = $statistic;
    }
    
    /**
     *
     * {@inheritDoc}
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     *
     * {@inheritDoc}
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     *
     * {@inheritDoc}
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     *
     * {@inheritDoc}
     */
    public function setModifiedAt($modifiedAt)
    {
        $this->modifiedAt = $modifiedAt;
    }

    /**
     *
     * {@inheritDoc}
     */
    public function getModifiedAt()
    {
        return $this->modifiedAt;
    }
}