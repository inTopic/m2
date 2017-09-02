<?php

namespace Heckfy\Health\Model\Metrics\PHPVersion;

use Heckfy\Health\Model\Metrics\Leaf;

class Metric extends Leaf
{
    public $code = 'PHPVersion';
    public static $path = 'metrics/php_version/active';

    public function getMetricValue()
    {
        return phpversion();
    }

}