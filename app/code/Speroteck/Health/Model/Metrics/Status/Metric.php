<?php

namespace Speroteck\Health\Model\Metrics\Status;

use Magento\Framework\Event\Observer;
use Speroteck\Health\Model\AbstractMetric;
use Magento\Framework\Event\ObserverInterface;

/**
 * Class Metric
 *
 * @package Speroteck\Health\Model\Metrics\ApacheVersion
 */
class Metric extends AbstractMetric implements ObserverInterface
{
    public $code = 'status';
    public $name = 'Status';
    public $value;

    /**
     * Metric constructor.
     *
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     */
    public function __construct(\Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
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
            $errorMetricArray = [];
            foreach ($metricManager->metrics as $metric) {
                try {
                    set_error_handler('myErrorHandler');
                    echo $nonExistedVariable;
                    callToUndefinedFunction();
                    $metric->getValue();
                } catch (\Exception $exception) {
                    $errorMetricArray[$metric->getCode()] = $exception->getMessage();
                    $metricManager->removeMetric($metric->getCode());
                }
            }
            if (empty($errorMetricArray)) {
                $this->value = 'OK';
            } else {
                $this->value = 'FALSE: ' . json_encode($errorMetricArray);
            }
            $metricManager->addMetric($this);
        }
        return $this;
    }

    function myErrorHandler($errno, $errstr, $errfile, $errline)
    {
        echo "Error $errno happened! $errstr on $errfile line $errline";
        die();
        return true;
    }


    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
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