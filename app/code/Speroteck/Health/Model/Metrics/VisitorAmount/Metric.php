<?php

namespace Speroteck\Health\Model\Metrics\VisitorAmount;


use Magento\Framework\Event\Observer;
use Speroteck\Health\Model\AbstractMetric;
use Magento\Framework\Event\ObserverInterface;

/**
 * Class Metric
 *
 * @package Speroteck\Health\Model\Metrics\VisitorAmount
 */
class Metric extends AbstractMetric implements ObserverInterface
{
    public $code = 'visitor_amount';
    public $name = 'Visitor Amount';
    public $visitor;
    public $scopeConfig;

    /**
     * Metric constructor.
     *
     * @param \Magento\Customer\Model\Visitor                    $visitor
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     */
    public function __construct(\Magento\Customer\Model\Visitor $visitor,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
        $this->visitor = $visitor;
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
     * @return int
     */
    public function getValue()
    {
        return $this->visitor->getCollection()->getSize();
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

}