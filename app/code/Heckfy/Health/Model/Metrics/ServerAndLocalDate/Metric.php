<?php

namespace Heckfy\Health\Model\Metrics\ServerAndLocalDate;

use Heckfy\Health\Model\Metrics\Leaf;

class Metric extends Leaf
{
    private $_date = null;
    public $code = 'ServerAndLocalDate';
    public static $path = 'metrics/server_and_local_date/active';

    public function __construct(
        \Magento\Framework\Stdlib\DateTime\DateTime $date,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->_date = $date;
    }

    public function getMetricValue()
    {
        return $this->_date->gmtDate();
    }

}