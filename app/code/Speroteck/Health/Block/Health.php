<?php
namespace Speroteck\Health\Block;

use Magento\Framework\View\Element\Template;

/**
 * Class Landingspage
 *
 * @package Speroteck\Health\Block
 */
class Health extends Template
{
    /**
     * metric manager
     */
    public $metricManager;

    /**
     * helper
     * @var \Speroteck\Health\Helper\Data
     */
    public $_scopeConfig;

    /**
     * Landingspage constructor.
     *
     * @param Template\Context                      $context
     * @param array                                 $data
     * @param \Speroteck\Health\Model\MetricManager $metricManager
     */
    public function __construct(Template\Context $context, array $data,
        \Speroteck\Health\Model\MetricManager $metricManager,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    ) {
        $this->_scopeConfig = $scopeConfig;
        $this->metricManager = $metricManager;
        parent::__construct($context, $data);
    }

    /**
     * @return array
     */
    public function getMetrics()
    {
        return $this->metricManager->getAllMetrics();
    }
}
