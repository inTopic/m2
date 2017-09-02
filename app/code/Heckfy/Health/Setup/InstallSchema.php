<?php

namespace Heckfy\Health\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class InstallSchema implements InstallSchemaInterface
{
    /**
     * @param SchemaSetupInterface   $setup
     * @param ModuleContextInterface $context
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
        $table = $installer->getConnection()->newTable($installer->getTable('heckfy_health_metrics'))
            ->addColumn(
                'metric_id', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true], 'Metric Id'
            )
            ->addColumn('name', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 64, ['nullable' => false], 'getName')
            ->addColumn(
                'created_at', \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP, null,
                ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT], 'Created at'
            )
            ->addColumn('updated_at', \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP, null, [], 'Updated at')
            ->addColumn(
                'enabled', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null,
                ['nullable' => false, 'default' => '1',], 'Enabled or not'
            );
        $installer->getConnection()->createTable($table);
        $installer->endSetup();
    }
}
