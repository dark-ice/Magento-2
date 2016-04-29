<?php
/**
* Copyright © 2016 Magecom
*/

namespace Magecom\Singularis\Model\Resource;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class Singularis
 * @package Magecom\Singularis\Model\Resource
 */
class Singularis extends AbstractDb
{
    /**
     * Define main table
     */
    protected function _construct()
    {
        $this->_init('magecom_singularis', 'id');
    }
}
