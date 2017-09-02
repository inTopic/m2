<?php

namespace Heckfy\Health\Model\Metrics\MysqlVersion;

use Heckfy\Health\Model\Metrics\Leaf;
use Heckfy\Health\Helper\Data;

class Metric extends Leaf
{
    public $code = 'MysqlVersion';
    private $_helper = null;
    public static $path = 'metrics/mysql_version/active';

    public function __construct(Data $helper, \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
        $this->_helper = $helper;
    }

    public function getMetricValue()
    {
        return $this->_helper->getMysqlVersion();
    }

}