<?php

namespace MQM\StatisticBundle\Model;

interface StatisticInterface
{
    /**
     * @return string
     */
    public function getId();

    /**
     * @return \DateTime
     */
    public function getCreatedAt();

    /**
     * @param string
     * @return string
     */
    public function setUsername($username);

    /**
     * @return string
     */
    public function getUsername();

    /**
     * @param string
     */
    public function setIp($ip);

    /**
     * @return string
     */
    public function getIp();
}