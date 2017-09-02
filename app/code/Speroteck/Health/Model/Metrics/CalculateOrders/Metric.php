<?php

namespace Speroteck\Health\Model\Metrics\CalculateOrders;

use Magento\Framework\Event\Observer;
use Speroteck\Health\Model\AbstractMetric;
use Magento\Framework\Event\ObserverInterface;

/**
 * Class Metric
 *
 * @package Speroteck\Health\Model\Metrics\CalculateOrders
 */
class Metric extends AbstractMetric implements ObserverInterface
{
    public $code = 'calculate_orders';
    public $name = 'Calculate Orders';
    public $collectionFactory;
    public $scopeConfig;

    /**
     * Metric constructor.
     *
     * @param \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $collectionFactory
     * @param \Magento\Framework\App\Config\ScopeConfigInterface         $scopeConfig
     */
    public function __construct(
        \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $collectionFactory,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->collectionFactory = $collectionFactory;
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
        return $this->collectionFactory->create()->getSize();
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