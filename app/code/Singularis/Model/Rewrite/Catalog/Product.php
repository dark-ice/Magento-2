<?php
/**
 * Copyright © 2016 Magecom
 */

namespace Magecom\Singularis\Model\Rewrite\Catalog;

use Magento\Catalog\Model\Product as MagentoProduct;

/**
 * Class Product
 * @package Magecom\Singularis\Model\Rewrite\Catalog
 */
class Product extends MagentoProduct
{
    /**
     * Get product status
     *
     * @return int
     */
    public function getStatus()
    {
        return \Magento\Catalog\Model\Product\Attribute\Source\Status::STATUS_ENABLED;
    }
}
