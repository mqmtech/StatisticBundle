<?php

namespace MQM\StatisticBundle\Entity;

use MQM\StatisticBundle\Model\StatisticInterface;
use MQM\StatisticBundle\Entity\Product;
use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Table(name="mqm_stat_order")
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks
 */
class OrderStatistic extends Statistic
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
     * @var string orderId
     *
     * @ORM\Column(name="orderId", type="string", length=255, nullable=true)
     */
    private $orderId;

    /**
     * Result of totalBasePrice * tax
     * @var float $taxPrice
     *
     * @ORM\Column(name="taxPrice", type="float", nullable=true)
     */
    private $taxPrice;

    /**
     *
     * @var float $shippingBasePrice
     *
     * @ORM\Column(name="shippingBasePrice", type="float", nullable=true)
     */
    private $shippingBasePrice;

    /**
     * Result of totalBasePrice + taxPrice
     *
     * @var float $totalPrice
     *
     * @ORM\Column(name="totalPrice", type="float", nullable=true)
     */
    private $totalPrice;

    public function __construct(){
        parent::__construct();
    }

    public function __toString(){
        return '' . $this->getOrderId();
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $orderId
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;
    }

    /**
     * @return string
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * @param float $shippingBasePrice
     */
    public function setShippingBasePrice($shippingBasePrice)
    {
        $this->shippingBasePrice = $shippingBasePrice;
    }

    /**
     * @return float
     */
    public function getShippingBasePrice()
    {
        return $this->shippingBasePrice;
    }

    /**
     * @param float $taxPrice
     */
    public function setTaxPrice($taxPrice)
    {
        $this->taxPrice = $taxPrice;
    }

    /**
     * @return float
     */
    public function getTaxPrice()
    {
        return $this->taxPrice;
    }

    /**
     * @param float $totalPrice
     */
    public function setTotalPrice($totalPrice)
    {
        $this->totalPrice = $totalPrice;
    }

    /**
     * @return float
     */
    public function getTotalPrice()
    {
        return $this->totalPrice;
    }
}