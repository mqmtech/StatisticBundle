<?php

namespace MQM\StatisticBundle\Test\Statistic;

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
        $this->statisticManager = $this->getMockedStatisticManager();//$this->get('mqm_statistic.statistic_manager');
    }

    protected function tearDown()
    {
        //$this->resetStatistics();
    }

    protected function get($service)
    {
        return $this->_container->get($service);
    }
    
    public function testGetAssertManager()
    {
        $this->assertNotNull($this->statisticManager);
    }

    public function testAddStatistic()
    {
        /**
         * @var \MQM\StatisticBundle\Entity\ProductViewStatistic
         */
        $statistic = $this->statisticManager->createStatistic('productViewStatistic');
        $this->statisticManager->save($statistic, true);
    }

    public function testAddStatisticWithProductDimension()
    {
        $product = $this->statisticManager->findOneBy(array('sku' => 'sku_3'), 'product');
        if ($product == null) {
            $product = $this->createProductDimension();
        }
        $productViewStatistic = $this->statisticManager->createStatistic('productViewStatistic');
        $productViewStatistic->setProduct($product);
        $this->statisticManager->save($productViewStatistic, true);
    }

    public function testGetMostViewedProducts()
    {
        $mostViewed = $this->statisticManager->findMostViewedProducts();
        $this->assertNotNull($mostViewed);
        foreach ($mostViewed as $group) {
            foreach ($group as $key => $statistic) {
                if (is_object($statistic)) {
                    echo $key . " = " . $statistic->getProduct()->getName();
                    print_r($statistic->getProduct());
                }
                else {
                    echo $statistic;
                }
            }
        }

    }

    private function createProductDimension()
    {
        $product = $this->statisticManager->createDimension('product');
        $product->setName('product_default');
        $product->setSku('sku_3');
        $product->setCategoryName('default_category');
        $product->setBrandName('brand_category');

        return $product;
    }

    private function getMockedStatisticManager()
    {
        $em = $this->get('doctrine')->getEntityManager();
        $statistics = array(
          'productViewStatistic' => 'MQM\StatisticBundle\Entity\ProductViewStatistic'
        );
        $dimensions = array(
            'product' => 'MQM\StatisticBundle\Entity\Product'
        );
        $securityContext = $this->get('security.context');
        $request = $this->mockRequest();

        return new \MQM\StatisticBundle\Entity\StatisticManager($em, $statistics, $dimensions, $securityContext, $request);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Request
     */
    public function mockRequest(){
        $spec = $this->getMockBuilder('\Symfony\Component\HttpFoundation\Request')->disableOriginalConstructor();
        $mock = $spec->getMock();

        return $mock;
    }

    private function resetStatistics()
    {
        $stats = $this->statisticManager->findAll('productViewStatistic');
        foreach ($stats as $stat) {
            $this->statisticManager->delete($stat, false);
        }
        $this->statisticManager->flush();
    }
}
