<?php

namespace Heckfy\Health\Helper;

use \Magento\Framework\DB\Helper;

class Data extends \Magento\Framework\DB\Helper
{
    /**
     * get mysql version
     */
    public function getMysqlVersion()
    {
        $information = $this->getConnection()->fetchRow('SHOW VARIABLES LIKE \'version\'');;
        return $information['Value'];
    }
}