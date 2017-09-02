<?php

namespace Heckfy\Health\Model\Metrics;

use Heckfy\Health\Model\MInterface;

abstract class Composite implements MInterface
{
    protected $metrics = array();

    public function getMetricValue()
    {
        $result = array();
        $result['STATUS'] = $this->isActive();
        foreach ($this->metrics as $metric) {
            $result[$metric->code] = $metric->getMetricValue();
        }
        return $result;
    }

    public function isActive()
    {
        foreach ($this->metrics as $metric) {
            if (!$metric->isActive()) {
                return 'FALSE';
            }
        }
        return 'OK';
    }

    public function addMetric(MInterface $metric)
    {
        if (in_array($metric, $this->metrics, true)) {
            return;
        }
        $this->metrics[] = $metric;
    }

    public function removeMetric(MInterface $metric)
    {
        $this->metrics = array_udiff(
            $this->metrics, array($metric), function ($a, $b) {
            return ($a === $b) ? 0 : 1;
        }
        );
    }

}