<?php

namespace Heckfy\Health\Model\Metrics\VisitorAmount;

use Heckfy\Health\Model\Metrics\Leaf;

class Metric extends Leaf
{
    public $code = 'visitor_amount';
    public static $path = 'metrics/visitor_amount/active';
    public function getMetricValue()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        return count($objectManager->create('Magento\Customer\Model\Visitor')->getCollection()->getData());
    }

}