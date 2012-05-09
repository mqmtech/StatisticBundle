<?php

namespace MQM\StatisticBundle\Entity;

use MQM\StatisticBundle\Model\StatisticInterface;
use MQM\StatisticBundle\Entity\Product;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="mqm_stat_order_item")
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks
 */
class OrderItemStatistic extends Statistic
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
     * @var integer $quantity
     * @ORM\Column(name="quantity", type="integer", nullable=true)
     */
    private $quantity = 1;

    /**
     * Price per unit
     *
     * @var float $basePrice
     *
     * @ORM\Column(name="basePrice", type="float", nullable=true)
     */
    private $basePrice;

    /**
     * @var float $totalBasePrice
     * @ORM\Column(name="totalBasePrice", type="float", nullable=true)
     */
    private $totalBasePrice;

    /**
     *
     * @var Product $product;
     *
     * @ORM\ManyToOne(targetEntity="MQM\StatisticBundle\Entity\Product", cascade={"persist"})
     * @ORM\JoinColumn(name="productId", referencedColumnName="id", nullable=true)
     */
    private $product;

    public function __construct(){
        parent::__construct();
    }

    public function __toString(){
        return '' . $this->getId();
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
     * @param float $basePrice
     */
    public function setBasePrice($basePrice)
    {
        $this->basePrice = $basePrice;
    }

    /**
     * @return float
     */
    public function getBasePrice()
    {
        return $this->basePrice;
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
     * @param int $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param float $totalBasePrice
     */
    public function setTotalBasePrice($totalBasePrice)
    {
        $this->totalBasePrice = $totalBasePrice;
    }

    /**
     * @return float
     */
    public function getTotalBasePrice()
    {
        return $this->totalBasePrice;
    }

    /**
     * @param \MQM\StatisticBundle\Entity\Product $product
     */
    public function setProduct($product)
    {
        $this->product = $product;
    }

    /**
     * @return \MQM\StatisticBundle\Entity\Product
     */
    public function getProduct()
    {
        return $this->product;
    }
}