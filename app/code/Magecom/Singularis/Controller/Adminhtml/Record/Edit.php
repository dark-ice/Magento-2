<?php
/**
 * Copyright © 2016 Magecom
 */

namespace Magecom\Singularis\Controller\Adminhtml\Record;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Backend\App\Action;
use Magento\Framework\Registry;

class Edit extends Action
{
    /**
     * @var \Magento\Backend\Model\View\Result\Page
     */
    protected $_resultPage;
    /**
     * @var PageFactory
     */
    protected $_resultPageFactory;

    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry;

    /**
     * Index constructor.
     * @param Context $context
     * @param Registry $coreRegistry
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        Registry $coreRegistry,
        PageFactory $resultPageFactory
    ) {
        $this->_coreRegistry = $coreRegistry;
        $this->_resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    /**
     * Index action
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        $this->_init();// Init result page $this->_resultPage

        $id = $this->getRequest()->getParam('record_id');
        $model = $this->_objectManager->create('Magecom\Singularis\Model\Record');

        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This record no longer exists.'));
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();

                return $resultRedirect->setPath('*/*/');
            }
        }

        $data = $this->_objectManager->get('Magento\Backend\Model\Session')->getFormData(true);
        if (!empty($data)) {
            $model->setData($data);
        }

        $this->_coreRegistry->register('record', $model);

        return $this->_resultPage;
    }

    /**
     * Initiates result page object, sets page title, sets active menu, sets breadcrumbs
     */
    protected function _init()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $this->_resultPage = $this->_resultPageFactory->create();

        /**
         * Set active menu item
         */
        $this->_resultPage->setActiveMenu('Magecom_Singularis::records');
        $this->_resultPage->getConfig()->getTitle()->prepend(__('Manage singularis records'));

        /**
         * Add breadcrumb item
         */
        $this->_resultPage->addBreadcrumb(__('Magecom_Singularis'), __('Manage records'));
        $this->_resultPage->addBreadcrumb(__('Manage Customers'), __('Manage records'));
    }

    /**
     * Is the user allowed to view the grid.
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Magecom_Singularis::records');
    }
}