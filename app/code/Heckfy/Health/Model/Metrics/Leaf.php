<?php
namespace Heckfy\Health\Model\Metrics;

use Heckfy\Health\Model\MInterface;

abstract class Leaf implements MInterface
{
    public static $path = '';
    public $scopeConfig;

    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * \Magento\Store\Model\ScopeInterface::SCOPE_STORE
     * @return mixed
     */
    public function isActive()
    {
        return $this->scopeConfig->getValue(static::$path);
    }
}