<?php

namespace MQM\StatisticBundle\Logger;

use MQM\StatisticBundle\Model\StatisticManagerInterface;

class ProductViewedLogger implements LoggerInterface
{
    private $statisticManager;

    public function __construct(StatisticManagerInterface $statisticManager)
    {
        $this->statisticManager = $statisticManager;
    }
    public function logStatistic($options = array())
    {
        $options = $options + $this->getDefaultOptions();
        if (!isset($options['product'])) {
            throw new \Exception('The product is not set in log statistics options');
        }
        $product = $options['product'];
        $productDimension = $this->statisticManager->findOneBy(array('sku' => $product->getSku()), 'product');
        if ($productDimension == null) {
            $productDimension = $this->statisticManager->createDimension('product');
            $productDimension->setName($product->getName());
            $productDimension->setSku($product->getSku());
            $productDimension->setCategoryName($product->getcategory()->getName());
            $productDimension->setBrandName($product->getBrand()->getName());
        }
        $productViewStatistic = $this->statisticManager->createStatistic('productViewStatistic');
        $productViewStatistic->setProduct($productDimension);
        $this->statisticManager->save($productViewStatistic, true);
    }

    public function getDefaultOptions()
    {
        return array(
        );
    }
}