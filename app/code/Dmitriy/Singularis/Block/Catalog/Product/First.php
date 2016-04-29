<?php
/**
* Copyright © 2015 Magecom. All rights reserved.
*/

namespace Magecom\Singularis\Block\Catalog\Product;

/**
 * Class First
 * @package Magecom\Singularis\Block\Catalog\Product
 */
class First extends \Magento\Framework\View\Element\Template
{
    protected $_helper;

    protected $_objectManager;

    /**
     * First constructor.
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     * @param \Magecom\Singularis\Helper\Data $helper
     * @param \Magento\Framework\ObjectManagerInterface $objectManager
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = [],
        \Magecom\Singularis\Helper\Data $helper,
        \Magento\Framework\ObjectManagerInterface $objectManager
    )
    {
        parent::__construct($context, $data);

        $this->_helper = $helper;
        $this->_objectManager = $objectManager;
    }

    /**
     * @return \Magecom\Singularis\Helper\Data
     */
    public function _getHelper()
    {
        return $this->_helper;
    }

    /**
     * @return \Magecom\Singularis\Model\Resource\Singularis\Collection
     */
    public function getSingularisCollection()
    {
        $model = $this->_objectManager->create('Magecom\Singularis\Model\Singularis');
        $collection = $model->getCollection();

        return $collection;
    }
}
