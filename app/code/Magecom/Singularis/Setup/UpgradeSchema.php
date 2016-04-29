<?php
/**
 * Copyright © 2016 Magecom
 */
namespace Magecom\Singularis\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\DB\Ddl\Table;

/**
 * Class UpgradeSchema
 * @package Magecom\Singularis\Setup
 */
class UpgradeSchema implements UpgradeSchemaInterface
{
    const TABLE_NAME_SINGULARIS = 'magecom_singularis';

    const TABLE_NAME_RECORDS = 'magecom_record';

    /**
     * Main method that is called when upgrade is running
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        // Should be run only for 0.0.1 - 0.0.2 upgrade
        if (version_compare($context->getVersion(), '0.0.1', '=')) {
            $this->_upgrade002($installer);
        }

        // Should be run only for 0.0.3 - 0.0.4 upgrade
        if (version_compare($context->getVersion(), '0.0.3', '=')) {
            $this->_upgrade004($installer);
        }

        $installer->endSetup();
    }

    /**
     * @param SchemaSetupInterface $installer
     */
    private function _upgrade002($installer)
    {
        // Check if the table already exists
        if ($installer->getConnection()->isTableExists($installer->getTable(self::TABLE_NAME_SINGULARIS))) {
            // Declare data
            $columns = [
                'imagename' => [
                    'type'      => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'nullable'  => false,
                    'comment'   => 'image name',
                ],
            ];

            $connection = $installer->getConnection();

            foreach ($columns as $name => $definition) {
                $connection->addColumn($installer->getTable(self::TABLE_NAME_SINGULARIS), $name, $definition);
            }

        }
    }

    /**
     * @param SchemaSetupInterface $installer
     */
    private function _upgrade004($installer)
    {
        // Check if the table already exists
        if (!$installer->getConnection()->isTableExists($installer->getTable(self::TABLE_NAME_RECORDS))) {
            $table = $installer->getConnection()
                ->newTable($installer->getTable(self::TABLE_NAME_RECORDS))
                ->addColumn(
                    'record_id',
                    Table::TYPE_SMALLINT,
                    null,
                    ['identity' => true, 'nullable' => false, 'primary' => true],
                    'Record ID'
                )
                ->addColumn('url_key', Table::TYPE_TEXT, 100, ['nullable' => true, 'default' => null])
                ->addColumn('title', Table::TYPE_TEXT, 255, ['nullable' => false], 'Record Title')
                ->addColumn('content', Table::TYPE_TEXT, '2M', [], 'Record content')
                ->addColumn(
                    'is_active',
                    Table::TYPE_SMALLINT,
                    null,
                    ['nullable' => false, 'default' => '1'], 'Is record active?')
                ->addColumn('creation_time', Table::TYPE_DATETIME, null, ['nullable' => false], 'Creation Time')
                ->addColumn('update_time', Table::TYPE_DATETIME, null, ['nullable' => false], 'Update Time')
                ->addIndex($installer->getIdxName('record_record', ['url_key']), ['url_key'])
                ->setComment('Magecom records');

            $installer->getConnection()->createTable($table);
        }
    }
}