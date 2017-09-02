<?php

namespace Heckfy\Health\Model\Metrics\CustomerAmount;

use Heckfy\Health\Model\Metrics\Leaf;

class Metric extends Leaf
{
    public $code = 'customer_amount';
    public static $path = 'metrics/customer_amount/active';

    public function getMetricValue()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        return count($objectManager->create('Magento\Customer\Model\Customer')->getCollection()->getData());
    }
}