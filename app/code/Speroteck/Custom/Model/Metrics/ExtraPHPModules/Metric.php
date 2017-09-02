<?php

namespace Speroteck\Custom\Model\Metrics\ExtraPHPModules;

use Magento\Framework\Event\Observer;
use Speroteck\Health\Model\AbstractMetric;
use Magento\Framework\Event\ObserverInterface;

/**
 * Class Metric
 *
 * @package Speroteck\Custom\Model\Metrics\ExtraPHPModules
 */
class Metric extends AbstractMetric implements ObserverInterface
{
    public $code = 'extra_php_modules';
    public $name = 'Extra PHP Modules';
    public $scopeConfig;

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
     * @return string
     */
    public function getValue()
    {
        $allExtensions = get_loaded_extensions();
        $onlyMagentoNeededExtensions = $this->getMagentoExtensions();
        return json_encode(array_diff($allExtensions, $onlyMagentoNeededExtensions));
    }

    /**
     * get only magento needed extensions array
     *
     * @return array
     */
    public function getMagentoExtensions()
    {
        return array('bcmath',
                     'curl',
                     'gd',
                     'imagemagick',
                     'intl',
                     'mbstring',
                     'mcrypt',
                     'mhash',
                     'openssl',
                     'pdo_mysql',
                     'simplexml',
                     'soap',
                     'xml',
                     'xsl',
                     'zip',
                     'json',
                     'iconv'
        );
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
     * @return boolean
     */
    public function isActive()
    {
        return $this->scopeConfig->getValue('metrics/' . $this->code . '/active');
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