<?php
namespace Heckfy\Health\Block;

use Magento\Framework\View\Element\Template;

class Landingspage extends Template
{
    protected $_objectManager = null;

    public function getMetrics()
    {
        $this->_objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $custom = $this->_objectManager->create('Heckfy\Health\Model\Custom');
        $allMetrics = $custom->getMetricValue();
        return $allMetrics;
    }
}
