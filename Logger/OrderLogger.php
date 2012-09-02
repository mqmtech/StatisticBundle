<?php

namespace MQM\StatisticBundle\Logger;

use MQM\StatisticBundle\Model\StatisticManagerInterface;
use MQM\OrderBundle\Model\OrderInterface;
use MQM\OrderBundle\Model\OrderItemInterface;
use MQM\ProductBundle\Model\ProductInterface;

class OrderLogger implements LoggerInterface
{
    private $statisticManager;

    public function __construct(StatisticManagerInterface $statisticManager)
    {
        $this->statisticManager = $statisticManager;
    }
    public function logStatistic($options = array())
    {
        $options = $options + $this->getDefaultOptions(array());
        if (!isset($options['order'])) {
            throw new \Exception('The order is not set in log statistics options');
        }
        $order = $options['order'];
        $this->logOrderStatistic($order);

        $items = $order->getItems();
        foreach($items as $item) {
            $this->logOrderItemStatistic($item, $order->getId());
        }
        $this->statisticManager->flush();
    }

    private function logOrderStatistic(OrderInterface $order)
    {
        $orderItemStatistic = $this->statisticManager->createStatistic('orderStatistic');
        $orderItemStatistic->setOrderId($order->getId());
        $orderItemStatistic->setShippingBasePrice($order->getShippingBasePrice());
        $orderItemStatistic->setTaxPrice($order->getTaxPrice());
        $orderItemStatistic->setTotalPrice($order->getTotalPrice());

        $this->statisticManager->save($orderItemStatistic);
    }

    private function logOrderItemStatistic(OrderItemInterface $item, $orderId)
    {
        $product = $item->getProduct();
        $productDimension = $this->getOrCreateProductDimensionByProduct($product);
        $orderItemStatistic = $this->statisticManager->createStatistic('orderItemStatistic');
        $orderItemStatistic->setOrderId($orderId);
        $orderItemStatistic->setProduct($productDimension);
        $orderItemStatistic->setQuantity($item->getQuantity());
        $orderItemStatistic->setBasePrice($item->getBasePrice());
        $orderItemStatistic->setTotalBasePrice($item->getTotalBasePrice());

        $this->statisticManager->save($orderItemStatistic);
    }

    private function getOrCreateProductDimensionByProduct(ProductInterface $product)
    {
        $productDimension = $this->statisticManager->findOneBy(array('sku' => $product->getSku()), 'product');
        if ($productDimension == null) {
            $productDimension = $this->statisticManager->createDimension('product');
            $productDimension->setName($product->getName());
            $productDimension->setSku($product->getSku());
            $productDimension->setCategoryName($product->getcategory()->getName());
            $productDimension->setBrandName($product->getBrand()->getName());
        }

        return $productDimension;
    }

    public function getDefaultOptions(array $options)
    {
        return array(
        );
    }
}