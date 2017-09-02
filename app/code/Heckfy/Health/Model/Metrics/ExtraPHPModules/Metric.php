<?php

namespace Heckfy\Health\Model\Metrics\ExtraPHPModules;

use Heckfy\Health\Model\Metrics\Leaf;
use Heckfy\Health\Model\MInterface;

class Metric extends Leaf
{
    public $code = 'ExtraPHPModules';
    public static $path = 'metrics/extra_php_modules/active';

    public function getMetricValue()
    {
        //@TODO here is we have to Exclude M2 require modules
        return json_encode(get_loaded_extensions());
    }

}