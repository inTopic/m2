<?php

namespace Heckfy\Health\Model\ResourceModel\Metrics;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * Define model & resource model
     */
    protected function _construct()
    {
        $this->_init(
            'Heckfy\Health\Model\Metrics',
            'Heckfy\Health\Model\ResourceModel\Metrics'
        );
    }
}
