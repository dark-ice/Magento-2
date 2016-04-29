<?php
/**
 * Copyright © 2016 Magecom
 */

namespace Magecom\Singularis\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * Class InstallSchema
 * @package Magecom\Singularis\Setup
 */
class InstallSchema implements InstallSchemaInterface
{
    const TABLE_NAME_SINGULARIS = 'magecom_singularis';

    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        // Check if table exist first
        if (!$setup->getConnection()->isTableExists($installer->getTable(self::TABLE_NAME_SINGULARIS))) {
            $table = $installer->getConnection()
                ->newTable($installer->getTable(self::TABLE_NAME_SINGULARIS))
                ->addColumn(
                    'id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                    'Id'
                )
                ->addColumn(
                    'label',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    null,
                    ['default' => null, 'nullable' => false],
                    'Name'
                )
                ->addColumn(
                    'value',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    null,
                    ['default' => null, 'nullable' => false],
                    'Stores'
                );
            $installer->getConnection()->createTable($table);
        }
        $installer->endSetup();
    }
}
