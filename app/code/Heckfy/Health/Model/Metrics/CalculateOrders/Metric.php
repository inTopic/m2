<?php

namespace Heckfy\Health\Model\Metrics\CalculateOrders;

use Heckfy\Health\Model\Metrics\Leaf;

class Metric extends Leaf
{
    public $code = 'order_amount';
    public static $path = 'metrics/calculate_orders/active';

    public function getMetricValue()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        return count($objectManager->create('Magento\Sales\Model\Order')->getCollection()->getData());
    }
}