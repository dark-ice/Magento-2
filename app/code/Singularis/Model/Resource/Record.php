<?php
/**
 * Copyright © 2016 Magecom
 */

namespace Magecom\Singularis\Model\Resource;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class Record
 * @package Magecom\Singularis\Model\Resource
 */
class Record extends AbstractDb
{
    /**
     * Define main table
     */
    protected function _construct()
    {
        $this->_init('magecom_record', 'record_id');
    }
}