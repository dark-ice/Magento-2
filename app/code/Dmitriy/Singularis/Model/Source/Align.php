<?php
/**
 * Copyright © 2016 Magecom. All rights reserved.
 */

namespace Magecom\Singularis\Model\Source;

/**
 * Class Align
 * @package Magecom\Singularis\Model\Source
 */
class Align implements \Magento\Framework\Option\ArrayInterface
{
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
            ['value' => 'left', 'label'     => __('Left')],
            ['value' => 'center', 'label'   => __('Center')],
            ['value' => 'right', 'label'    => __('Right')],
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
