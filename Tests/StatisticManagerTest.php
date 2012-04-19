<?php

namespace MQM\StatisticBundle\Test\Statistic;

use MQM\StatisticBundle\Statistic\StatisticInterface;
use MQM\StatisticBundle\Model\StatisticManagerInterface;
use Symfony\Bundle\FrameworkBundle\Tests\Functional\AppKernel;

class StatisticManagerTest extends \Symfony\Bundle\FrameworkBundle\Test\WebTestCase
{   
    protected $_container;
    private $statisticManager;

    public function __construct()
    {
        parent::__construct();
        
        $client = static::createClient();
        $container = $client->getContainer();
        $this->_container = $container;  
    }
    
    protected function setUp()
    {
        $this->statisticManager = $this->get('mqm_statistic.statistic_manager');
    }

    protected function tearDown()
    {
        $this->resetStatistics();
    }

    protected function get($service)
    {
        return $this->_container->get($service);
    }
    
    public function testGetAssertManager()
    {
        $this->assertNotNull($this->statisticManager);
    }
    
    private function resetStatistics()
    {
        $categories = $this->statisticManager->findStatistics();
        foreach ($categories as $statistic) {
            $this->statisticManager->deleteStatistic($statistic, false);
        }
        $this->statisticManager->flush();
    }
}
