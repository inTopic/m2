<?php
namespace Heckfy\Health\Model;

use Heckfy\Health\Api\HealthInterface;
use Heckfy\Health\Helper\Data;
use Symfony\Component\Config\Definition\Exception\Exception;
use Heckfy\Health\Model\MetricsFactory;

class Health implements HealthInterface
{
    /**
     * @var \Heckfy\Health\Model\MetricsFactory
     */
    protected $_modelMetricsFactory;
    protected $_objectManager = null;
    protected $_result = null;
    protected $_helper;
    protected $_date;

    public function __construct(
        Data $helper,
        \Magento\Framework\Stdlib\DateTime\DateTime $date,
        MetricsFactory $modelMetricsFactory
    ) {

        $this->_modelMetricsFactory = $modelMetricsFactory;
        $this->_date = $date;
        $this->_helper = $helper;
        $this->_objectManager = \Magento\Framework\App\ObjectManager::getInstance();
    }

    /**
     *
     * @api
     *
     * @return full needed information
     */
    public function health()
    {
        $result['status'] = $this->getStatus();
        $result['result'] = $this->_result;
        return array($result);
    }

    /**
     * @api
     *
     * @return run all metrics
     */
    public function run()
    {
        if (is_null($this->_result)) {
            $metricsObj = $this->_modelMetricsFactory->create();
            $metrics = $metricsObj->getCollection()->getData();
            foreach ($metrics as $metric) {
                $action = 'get' . $metric['name'];
                if (is_callable(array($this, $action))) {
                    $this->_result[$metric['name']] = $this->$action();
                }
            }
        }
        return $this->_result;
    }

    /**
     * @api
     *
     * @return string Greeting message with metric status
     */
    public function getStatus()
    {
        try {
            $this->run();
        } catch (Exception $e) {
            return 'ERROR';
        }
        return 'OK';
    }

    /**
     * @api
     *
     * @return customer amount
     */
    protected function getCustomersAmount()
    {
        return count($this->_objectManager->create('Magento\Customer\Model\Customer')->getCollection()->getData());
    }

    /**
     * @api
     *
     * @return visitors amount
     */
    protected function getVisitorsAmount()
    {
        return count($this->_objectManager->create('Magento\Customer\Model\Visitor')->getCollection()->getData());
    }

    /**
     * @api
     *
     * @return orders amount
     */
    protected function getOrdersAmount()
    {
        return count($this->_objectManager->create('Magento\Sales\Model\Order')->getCollection()->getData());
    }

    /**
     * @api
     *
     * @return php version
     */
    protected function getPHPVersion()
    {
        return phpversion();
    }

    /**
     *
     * @api
     *
     * @return apache verision
     */
    protected function getApacheVersion()
    {
        return apache_get_version();
    }

    /**
     * @api
     *
     * @return mysql version
     */
    protected function getMysqlVersion()
    {
        ;
        return $this->_helper->getMysqlVersion();
    }

    /**
     * @api
     *
     * @return date
     */
    protected function getDate()
    {
        return $this->_date->gmtDate();
    }

    /**
     * @api
     *
     * @return extensions information
     */
    protected function getLoadedExtensionInformation()
    {
        return get_loaded_extensions();
    }


}
