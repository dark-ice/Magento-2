<?php
/**
 * Copyright © 2016 Magecom
 */

namespace Magecom\Singularis\Block\Adminhtml;

use Magento\Backend\Block\Widget\Grid\Container;

/**
 * Class Record
 * @package Magecom\Singularis\Block\Adminhtml
 */
class Record extends Container
{
    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_controller = 'adminhtml_record';
        $this->_blockGroup = 'Magecom_Singularis';
        $this->_headerText = __('Manage records');
        $this->_addButtonLabel = __('Add record');
        parent::_construct();
    }
}
