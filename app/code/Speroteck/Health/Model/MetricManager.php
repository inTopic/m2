<?php

namespace Speroteck\Health\Model;

/**
 * Class MetricManager
 *
 * @package Speroteck\Health\Model
 */
class MetricManager
{
    public $metrics = array();
    protected $eventManager;

    /**
     * MetricManager constructor.
     *
     * @param \Magento\Framework\Event\ManagerInterface $eventManager
     */
    public function __construct(
        \Magento\Framework\Event\ManagerInterface $eventManager
    ) {
        $this->eventManager = $eventManager;
        $this->eventManager->dispatch('speroteck_event_metrics_init', ['metric_manager' => $this]);
    }

    /**
     * @param $metric
     */
    public function addMetric(MetricInterface $metric)
    {
        if (!in_array($metric, $this->metrics)) {
            $this->metrics[] = $metric;
        }
        return;
    }

    /**
     * @param $code
     */
    public function removeMetric($code)
    {
        foreach ($this->metrics as $key => $metric) {
            if ($metric->code == $code) {
                unset($this->metrics[$key]);
            }
        }
    }

    /**
     * @return array|mixed
     */
    public function getAllMetrics()
    {
        $this->eventManager->dispatch('speroteck_status_metric', ['metric_manager' => $this]);
        return $this->metrics;
    }


}