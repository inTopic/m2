<?php

namespace Heckfy\Health\Model\Metrics\ApacheVersion;

use Heckfy\Health\Model\Metrics\Leaf;

class Metric extends Leaf
{
    public $code = 'apache_version';
    public static $path = 'metrics/apache_version/active';

    public function getMetricValue()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        return count($objectManager->create('Magento\Customer\Model\Customer')->getCollection()->getData());
    }
}