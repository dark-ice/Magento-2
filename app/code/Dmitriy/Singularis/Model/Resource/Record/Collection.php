<?php
/**
 * Copyright © 2016 Magecom
 */

namespace Magecom\Singularis\Model\Resource\Record;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 * @package Magecom\Singularis\Model\Resource\Record
 */
class Collection extends AbstractCollection
{
    /**
     * Define model & resource model
     */
    protected function _construct()
    {
        $this->_init(
            'Magecom\Singularis\Model\Record',
            'Magecom\Singularis\Model\Resource\Record'
        );
    }
}
