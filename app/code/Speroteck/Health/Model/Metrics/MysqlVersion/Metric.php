<?php

namespace Speroteck\Health\Model\Metrics\MysqlVersion;


use Magento\Framework\Event\Observer;
use Speroteck\Health\Model\AbstractMetric;
use Magento\Framework\Event\ObserverInterface;
use Speroteck\Health\Helper\Data;
use Symfony\Component\Config\Definition\Exception\Exception;

/**
 * Class Metric
 *
 * @package Speroteck\Health\Model\Metrics\MysqlVersion
 */
class Metric extends AbstractMetric implements ObserverInterface
{
    public $code = 'mysql_version';
    public $name = 'Mysql version';
    public $_helper = null;
    public $scopeConfig;

    /**
     * Metric constructor.
     *
     * @param Data                                               $helper
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     */
    public function __construct(Data $helper,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->_helper = $helper;
    }

    /**
     *
     * @param Observer $observer
     *
     * @return $this
     */
    public function execute(Observer $observer)
    {
        if ($this->isActive()) {
            $metricManager = $observer->getData('metric_manager');
            $metricManager->addMetric($this);
        }
        return $this;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->_helper->getMysqlVersion();
    }

    /**
     * @return boolean
     */
    public function isActive()
    {
        return $this->scopeConfig->getValue('metrics/general/' . $this->code);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    public function getErrorMessage()
    {
        return $this->errorMessage;
    }
}