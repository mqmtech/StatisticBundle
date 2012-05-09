<?php

namespace MQM\StatisticBundle\Entity;

use MQM\StatisticBundle\Model\StatisticInterface;
use MQM\StatisticBundle\Entity\Product;
use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Table(name="mqm_stat_product_view")
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks
 */
class ProductViewStatistic extends Statistic
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
        return '' . $this->getProduct()->getName();
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