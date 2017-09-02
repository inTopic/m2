<?php

namespace Speroteck\Health\Model\Metrics\CustomerAmount;


use Magento\Framework\Event\Observer;
use Speroteck\Health\Model\AbstractMetric;
use Magento\Framework\Event\ObserverInterface;
use Magento\Customer\Model\Customer;

/**
 * Class Metric
 *
 * @package Speroteck\Health\Model\Metrics\CustomerAmount
 */
class Metric extends AbstractMetric implements ObserverInterface
{
    public $code = 'customer_amount';
    public $name = 'Customer Amount';
    public $customer;
    public $scopeConfig;

    /**
     * Metric constructor.
     *
     * @param Customer                                           $customer
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        \Magento\Customer\Model\Customer $customer,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->customer = $customer;
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
        return $this->customer->getCollection()->getSize();
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