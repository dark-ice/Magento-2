<?php
/**
 * Copyright © 2016 Magecom
 */

namespace Magecom\Singularis\Plugin;

use Magento\Catalog\Model\Product;

/**
 * Class ProductPlugin
 * @package Magecom\Singularis\Plugin
 */
class ProductPlugin
{
    /**
     * @param Product $subject
     * @param $result
     * @return int
     */
    public function afterGetStatus(Product $subject, $result)
    {
        $result = \Magento\Catalog\Model\Product\Attribute\Source\Status::STATUS_ENABLED;

        return $result;
    }

    /**
     * @param Product $subject
     * @param $result
     * @return string
     */
    public function afterGetName(Product $subject, $result)
    {
        $result = $result . ' ' . ' very low price!';

        return $result;
    }

/*
    You cannot use plug-ins for:
    Final methods / classes
    Non-public methods
    Class methods (such as static methods)
    Inherited methods
    __construct
    Virtual types

*/
}
