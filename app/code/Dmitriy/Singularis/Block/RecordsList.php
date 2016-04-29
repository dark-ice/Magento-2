<?php
/**
 * Copyright © 2016 Magecom
 */

namespace Magecom\Singularis\Block;

/**
 * Class RecordsList
 * @package Magecom\Singularis\Block
 */
class RecordsList extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Magecom\Singularis\Helper\Data
     */
    protected $_helper;

    /**
     * @var \Magecom\Singularis\Helper\Another\Data
     */
    protected $_anotherHelper;

    /**
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $_objectManager;

    /**
     * RecordsList constructor.
     *
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     * @param \Magecom\Singularis\Helper\Data $helper
     * @param \Magecom\Singularis\Helper\Another\Data $anotherHelper
     * @param \Magento\Framework\ObjectManagerInterface $objectManager
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = [],
        \Magecom\Singularis\Helper\Data $helper,
        \Magecom\Singularis\Helper\Another\Data $anotherHelper,
        \Magento\Framework\ObjectManagerInterface $objectManager
    )
    {
        parent::__construct($context, $data);

        $this->_helper = $helper;
        $this->_anotherHelper = $anotherHelper;
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
     * @return \Magecom\Singularis\Helper\Another\Data
     */
    public function _getAnotherHelper()
    {
        return $this->_anotherHelper;
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

    /**
     * Get URL for controller.
     *
     * @return string
     */
    public function getSomeControllerUrl($url)
    {
        // Example 'adminhtml/*/start'
        return $this->getUrl($url);
    }
}
