<?php
/**
 * Copyright © 2016 Magecom
 */

namespace Magecom\Singularis\Block\Adminhtml\Record\Edit;

use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Registry;
use Magento\Framework\Data\FormFactory;
use Magento\Store\Model\System\Store;
use Magento\Cms\Model\Wysiwyg\Config;

use Magecom\Singularis\Model\System\Config\State;

/**
 * Class Form
 * @package Magecom\Singularis\Block\Adminhtml\Record\Edit
 */
class Form extends Generic
{
    /**
     * @var Registry
     */
    protected $_coreRegistry = null;

    /**
     * @var Store
     */
    protected $_systemStore;


    /**
     * @var State
     */
    protected $_state;

    /**
     * @var Config
     */
    protected $_wysiwygConfig;


    public function __construct(
        Context $context,
        Registry $registry,
        FormFactory $formFactory,
        Store $systemStore,
        State $state,
        Config $wysiwygConfig,
        array $data = []
    ) {
        $this->_systemStore = $systemStore;
        $this->_state = $state;
        $this->_wysiwygConfig = $wysiwygConfig;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Init form
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('record_form');
        $this->setTitle(__('Record data'));
    }

    /**
     * Prepare form
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        /** @var \Magecom\Singularis\Model\Record $model */
        $model = $this->_coreRegistry->registry('record');

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create(
            ['data' => ['id' => 'edit_form', 'action' => $this->getData('action'), 'method' => 'post']]
        );

        $form->setHtmlIdPrefix('record_');

        $fieldset = $form->addFieldset(
            'base_fieldset',
            ['legend' => __('General'), 'class' => 'fieldset-wide']
        );

        if ($model->getRecordId()) {
            $fieldset->addField('record_id', 'hidden', ['name' => 'record_id']);
        }

        $fieldset->addField(
            'title',
            'text',
            ['name' => 'title', 'label' => __('Record title'), 'title' => __('Record title'), 'required' => true]
        );

        $fieldset->addField(
            'url_key',
            'text',
            [
                'name' => 'url_key',
                'label' => __('URL key'),
                'title' => __('URL key'),
                'required' => true,
                'class' => 'validate-xml-identifier'
            ]
        );

        $fieldset->addField(
            'is_active',
            'select',
            [
                'label' => __('State'),
                'title' => __('State'),
                'name' => 'is_active',
                'required' => true,
                'options' => [
                    State::ACTIVE => __('Active'),
                    State::NOT_ACTIVE => __('Not active'),
                ],
            ]
        );
        if (!$model->getId()) {
            $model->setData('is_active', State::ACTIVE);
        }

        $widgetFilters = ['is_email_compatible' => 1];
        $wysiwygConfig = $this->_wysiwygConfig->getConfig(['widget_filters' => $widgetFilters]);

        $fieldset->addField(
            'content',
            'editor',
            [
                'name' => 'content',
                'label' => __('Content'),
                'title' => __('Content'),
                'required' => true,
                'style' => 'height: 600px;',
                'config' => $wysiwygConfig,
            ]
        );

        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
