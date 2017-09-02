<?php

namespace Heckfy\Health\Model\Metrics;

use Magento\Customer\Test\TestStep\OpenCustomerOnBackendStep;

class Branch extends Composite
{
    protected $_objectManager = null;

    public function __construct()
    {
        $this->_objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $this->addMetric($this->_objectManager->create('Heckfy\Health\Model\Metrics\ApacheVersion\Metric'));
        $this->addMetric($this->_objectManager->create('Heckfy\Health\Model\Metrics\CustomerAmount\Metric'));
        $this->addMetric($this->_objectManager->create('Heckfy\Health\Model\Metrics\VisitorAmount\Metric'));
        $this->addMetric($this->_objectManager->create('Heckfy\Health\Model\Metrics\CalculateOrders\Metric'));
        $this->addMetric($this->_objectManager->create('Heckfy\Health\Model\Metrics\PHPVersion\Metric'));
        $this->addMetric($this->_objectManager->create('Heckfy\Health\Model\Metrics\MysqlVersion\Metric'));
        $this->addMetric($this->_objectManager->create('Heckfy\Health\Model\Metrics\ServerAndLocalDate\Metric'));
        $this->addMetric($this->_objectManager->create('Heckfy\Health\Model\Metrics\ExtraPHPModules\Metric'));
    }

}
