<?php

namespace Heckfy\Health\Model;

use Heckfy\Health\Model\Metrics\Branch;
use Heckfy\Health\Model\Metrics\Composite;

class Custom extends Branch
{
    protected $_objectManager = null;

    public function __construct()
    {
        $this->_objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $this->addMetric($this->_objectManager->create('Heckfy\Health\Model\CustomMetric'));
        return parent::__construct();
    }
}