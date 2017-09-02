<?php

namespace Speroteck\Health\Helper;

use \Magento\Framework\DB\Helper;

/**
 * Class Data
 *
 * @package Speroteck\Health\Helper
 */
class Data extends \Magento\Framework\DB\Helper
{

    /**
     * get mysql version
     */
    public function getMysqlVersion()
    {
        $information = $this->getConnection()->fetchRow('SHOW VARIABLES LIKE \'version\'');
        return $information['ValueMMM'];
    }

}