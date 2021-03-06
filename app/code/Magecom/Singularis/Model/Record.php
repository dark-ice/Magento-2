<?php
/**
 * Copyright © 2016 Magecom
 */

namespace Magecom\Singularis\Model;

use Magento\Framework\Model\AbstractModel;

/**
 * Class Singularis
 * @package Magecom\Singularis\Model\Record
 */
class Record extends AbstractModel
{
    /**
     * Define resource model
     */
    protected function _construct()
    {
        $this->_init('Magecom\Singularis\Model\Resource\Record');
    }
}