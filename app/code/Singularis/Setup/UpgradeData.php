<?php
/**
 * Copyright © 2016 Magecom
 */

namespace Magecom\Singularis\Setup;

use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * Class UpgradeData
 * @package Magecom\Singularis\Setup
 */
class UpgradeData implements UpgradeDataInterface
{
    const TABLE_NAME_SINGULARIS = 'magecom_singularis';

    const TABLE_NAME_RECORDS = 'magecom_record';

    /**
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        // Should be run only for 0.0.2 - 0.0.3 upgrade
        if (version_compare($context->getVersion(), '0.0.2', '=')) {
            $this->_upgradeData002($setup);
        }
        // Should be run only for 0.0.3 - 0.0.4 upgrade
        if (version_compare($context->getVersion(), '0.0.3', '=')) {
            $this->_upgradeData004($setup);
        }

        $setup->endSetup();
    }

    /**
     * @param ModuleDataSetupInterface $setup
     */
    private function _upgradeData002($setup)
    {
        // Check if the table already exists
        if ($setup->getConnection()->isTableExists($setup->getTable(self::TABLE_NAME_SINGULARIS))) {
            $data = array(
                array(
                    'label'     => 'Sunset',
                    'value'     => 5,
                    'imagename' => 'sunset',
                ),
                array(
                    'label'     => 'Autumn',
                    'value'     => 17,
                    'imagename' => 'autumn',
                ),
                array(
                    'label'     => 'Spring',
                    'value'     => 77,
                    'imagename' => 'spring',
                ),
            );
            $setup->getConnection()->insertMultiple($setup->getTable(self::TABLE_NAME_SINGULARIS), $data);
        }
    }

    /**
     * @param ModuleDataSetupInterface $setup
     */
    private function _upgradeData004($setup)
    {
        // Check if the table already exists
        if ($setup->getConnection()->isTableExists($setup->getTable(self::TABLE_NAME_RECORDS))) {
            $data = array(
                array(
                    'url_key'   => 'first_ever',
                    'title'     => 'My first record',
                    'content'   => 'Some text will be here',
                    'is_active' => 1,
                ),
            );
            $setup->getConnection()->insertMultiple($setup->getTable(self::TABLE_NAME_RECORDS), $data);
        }
    }
}