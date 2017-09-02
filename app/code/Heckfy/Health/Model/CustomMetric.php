<?php

namespace Heckfy\Health\Model;

use Heckfy\Health\Model\Metrics\Leaf;
use Heckfy\Health\Model\MInterface;

class CustomMetric extends Leaf
{
    public $code = 'custom_metric';
    public static $path = 'metrics/custom_metric/active';

    public function getMetricValue()
    {
        return 'custom metric value';
    }

}