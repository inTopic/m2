<?php

namespace Speroteck\Health\Model\Metrics\ServerAndLocalDate;


use Magento\Framework\Event\Observer;
use Speroteck\Health\Model\AbstractMetric;
use Magento\Framework\Event\ObserverInterface;

/**
 * Class Metric
 *
 * @package Speroteck\Health\Model\Metrics\ServerAndLocalDate
 */
class Metric extends AbstractMetric implements ObserverInterface
{
    public $code = 'server_and_local_date';
    public $name = 'Server And Local Date';
    private $_date;
    public $scopeConfig;

    /**
     * Metric constructor.
     *
     * @param \Magento\Framework\Stdlib\DateTime\DateTime        $date
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        \Magento\Framework\Stdlib\DateTime\DateTime $date,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->_date = $date;
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
     * @return string
     */
    public function getValue()
    {
        // install script, which create simple product, disable shipping and payment.
        // конфигурация, в которой можно настроить необходимый продукт, шиппинг, пеймент метод(изначально все сетиться через инстал скрипт)
        // will think about it
        //

        // отдельный template для метрики и javascript
        // server time тоже динамический

        // провести полноценный чекаут
        // 2 метрики, 1-я cart check, 2-я place order
        // новую метрику (checkout, отдельным модулем), через API, которая будет проходить чекаут, плейсить, и удалять. Simple product(description do not touch me, sku: health check, price: 0!), убедиться, что в стоке(отключить чекание стока в инсталл скрипте)

        // добавить параметр на страницу display=all, либо коды метрик, которые покажут отдельно
        // кнопка check возле каждой метрики

        // возвращать блок, с темлейтом который включает js
        $localTimeIsScript
            = '<script> setInterval(function(){ document.getElementById("local_date").innerHTML = Date(); },1000) </script> <span>Local time is: <span id="local_date"></span></span><span><br>Server time is: ' . $this->_date->gmtDate() . '</span>';
        return $localTimeIsScript;
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