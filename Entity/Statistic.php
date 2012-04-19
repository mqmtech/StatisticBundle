<?php

namespace MQM\StatisticBundle\Entity;

use MQM\StatisticBundle\Model\StatisticInterface;
use MQM\StatisticBundle\Model\StatisticEntryInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Table(name="mqm_statistic")
 * @ORM\Entity(repositoryClass="MQM\StatisticBundle\Entity\StatisticRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Statistic implements StatisticInterface
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
     * @var string $targetDomain
     *
     * @ORM\Column(name="targetDomain", type="string", length=255, nullable=true)
     */
    private $targetDomain;
    
    /**
     * @var string $targetId
     *
     * @ORM\Column(name="targetId", type="string", length=255, nullable=true)
     */
    private $targetId;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var text $description
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;
    
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
     * @ORM\OneToMany(targetEntity="MQM\StatisticBundle\Entity\StatisticEntry", mappedBy="statistic")
     * @var array $entries
     */
    private $entries;
    
    public function __construct(){
        $this->createdAt = new \DateTime();
    }
    
    public function __toString(){
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
    public function setEntries(array $entries){
        $this->entries = $entries;
    }
    
    /**
     *
     * {@inheritDoc}
     */
    public function getEntries(){
        return $this->entries;
    }
    
    /**
     *
     * {@inheritDoc}
     */
    public function addEntry(StatisticEntryInterface $entry)
    {
        if (!in_array($entry, $this->entries, true)) {
            $this->roles[] = $entry;
        }
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
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     *
     * {@inheritDoc}
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     *
     * {@inheritDoc}
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     *
     * {@inheritDoc}
     */
    public function getDescription()
    {
        return $this->description;
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
    
    /**
     *
     * {@inheritDoc}
     */
    public function getTargetDomain()
    {
        return $this->targetDomain;
    }

    /**
     *
     * {@inheritDoc}
     */
    public function setTargetDomain($targetDomain)
    {
        $this->targetDomain = $targetDomain;
    }

    /**
     *
     * {@inheritDoc}
     */
    public function getTargetId()
    {
        return $this->targetId;
    }

    /**
     *
     * {@inheritDoc}
     */
    public function setTargetId($targetId)
    {
        $this->targetId = $targetId;
    }
}