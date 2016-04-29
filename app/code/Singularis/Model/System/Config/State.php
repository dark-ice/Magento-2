<?php
/**
 * Copyright © 2016 Magecom. All rights reserved.
 */

namespace Magecom\Singularis\Model\System\Config;

use Magento\Framework\Option\ArrayInterface;

/**
 * Class State
 * @package Magecom\Singularis\Model\System\Config
 */
class State implements ArrayInterface
{
    const NOT_ACTIVE  = 0;

    const ACTIVE = 1;

    /**
     * @var array
     */
    protected $_options;

    /**
     * Initialize the options array
     */
    public function __construct()
    {
        $this->_options = [
            ['value' => self::NOT_ACTIVE, 'label' => __('Not active')],
            ['value' => self::ACTIVE, 'label' => __('Active')],
        ];
    }

    /**
     * @return array
     */
    public function toOptionArray()
    {
        return $this->_options;
    }
}