<?php

namespace Heckfy\Health\Model;

use Magento\Framework\Model\AbstractModel;

class Metrics extends AbstractModel
{
    /**
     * Define resource model
     */
    protected function _construct()
    {
        $this->_init('Heckfy\Health\Model\ResourceModel\Metrics');
    }
}
