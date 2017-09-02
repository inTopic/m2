<?php

namespace Heckfy\Health\Setup;

use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class UpgradeData implements UpgradeDataInterface
{
    public function upgrade(
        ModuleDataSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $setup->startSetup();
        if (version_compare($context->getVersion(), '1.0.1') < 0) {
            $tableName = $setup->getTable('heckfy_health_metrics');
            $date = date('Y-m-d H:i:s');
            // Check if the table already exists
            if ($setup->getConnection()->isTableExists($tableName) == true) {
                // Declare data
                $data = [
                    [
                        'name'       => 'CustomersAmount',
                        'created_at' => $date,
                        'updated_at' => $date,
                        'enabled'    => 1
                    ],
                    [
                        'name'       => 'VisitorsAmount',
                        'created_at' => $date,
                        'updated_at' => $date,
                        'enabled'    => 1
                    ],
                    [
                        'name'       => 'OrdersAmount',
                        'created_at' => $date,
                        'updated_at' => $date,
                        'enabled'    => 1
                    ],
                    [
                        'name'       => 'PHPVersion',
                        'created_at' => $date,
                        'updated_at' => $date,
                        'enabled'    => 1
                    ],
                    [
                        'name'       => 'ApacheVersion',
                        'created_at' => $date,
                        'updated_at' => $date,
                        'enabled'    => 1
                    ],
                    [
                        'name'       => 'MysqlVersion',
                        'created_at' => $date,
                        'updated_at' => $date,
                        'enabled'    => 1
                    ],
                    [
                        'name'       => 'Date',
                        'created_at' => $date,
                        'updated_at' => $date,
                        'enabled'    => 1
                    ],
                    [
                        'name'       => 'LoadedExtensionInformation',
                        'created_at' => $date,
                        'updated_at' => $date,
                        'enabled'    => 1
                    ],

                ];

                // Insert data to table
                foreach ($data as $item) {
                    $setup->getConnection()->insert($tableName, $item);
                }
            }
        }

        $setup->endSetup();
    }
}