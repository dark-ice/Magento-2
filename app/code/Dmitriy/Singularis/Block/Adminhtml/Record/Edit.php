<?php
/**
 * Copyright © 2016 Magecom
 */

namespace Magecom\Singularis\Block\Adminhtml\Record;

use Magento\Backend\Block\Widget\Form\Container;
use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Registry;

/**
 * Class Edit
 * @package Magecom\Singularis\Block\Adminhtml\Record
 */
class Edit extends Container
{
    /**
     * Core registry
     *
     * @var Registry
     */
    protected $_coreRegistry = null;

    /**
     * @param Context $context
     * @param Registry $registry
     * @param array $data
     */
    public function __construct(Context $context, Registry $registry, array $data = [])
    {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }

    /**
     * Initialize record edit block
     */
    protected function _construct()
    {
        $this->_objectId = 'record_id';
        $this->_blockGroup = 'Magecom_Singularis';
        $this->_controller = 'adminhtml_record';

        parent::_construct();

        if ($this->_isAllowedAction('Magecom_Singularis::records')) {
            $this->buttonList->update('save', 'label', __('Save record'));
            $this->buttonList->add(
                'saveandcontinue',
                [
                    'label' => __('Save and continue edit'),
                    'class' => 'save',
                    'data_attribute' => [
                        'mage-init' => [
                            'button' => ['event' => 'saveAndContinueEdit', 'target' => '#edit_form'],
                        ],
                    ]
                ],
                -100
            );
        } else {
            $this->buttonList->remove('save');
        }

        if ($this->_isAllowedAction('Magecom_Singularis::records')) {
            $this->buttonList->update('delete', 'label', __('Delete record'));
        } else {
            $this->buttonList->remove('delete');
        }
    }

    /**
     * Retrieve text for header element depending on loaded post
     *
     * @return \Magento\Framework\Phrase
     */
    public function getHeaderText()
    {
        if ($this->_coreRegistry->registry('blog_post')->getId()) {
            return __("Edit Post '%1'", $this->escapeHtml($this->_coreRegistry->registry('record')->getTitle()));
        } else {
            return __('New Post');
        }
    }

    /**
     * Getter of url for "Save and Continue" button
     * tab_id will be replaced by desired by JS later
     *
     * @return string
     */
    protected function _getSaveAndContinueUrl()
    {
        return $this->getUrl('magecom_singularis/*/save', ['_current' => true, 'back' => 'edit', 'active_tab' => '']);
    }

    /**
     * Check permission for action
     *
     * @param string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
}
