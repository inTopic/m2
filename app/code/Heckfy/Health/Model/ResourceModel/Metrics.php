<?php
namespace Heckfy\Health\Model\ResourceModel;
class Metrics extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    public function _construct()
    {
        $this->_init('heckfy_health_metrics', 'metric_id');
    }

}