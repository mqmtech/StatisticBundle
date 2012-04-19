<?php

namespace MQM\StatisticBundle\Model;

interface StatisticInterface
{
    /**
    *
    * @param array $entries
    */
    public function setEntries(array $entries);
            
    /**
     * @return array
     */
    public function getEntries();
    
    /**
     * @param StatisticEntryInterface $entry
     */
    public function addEntry(StatisticEntryInterface $entry);
            
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId();
            
    /**
     * Set name
     *
     * @param string $name
     */
    public function setName($name);

    /**
     * Get name
     *
     * @return string 
     */
    public function getName();

    /**
     * Set description
     *
     * @param text $description
     */
    public function setDescription($description);

    /**
     * Get description
     *
     * @return text 
     */
    public function getDescription();
    
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
    
    /**
     * @return string 
     */
    public function getTargetDomain();

    /**
     * @param string 
     */
    public function setTargetDomain($targetDomain);

    /**
     * @return integer 
     */
    public function getTargetId();

    /**
     * @param integer 
     */
    public function setTargetId($targetId);
}