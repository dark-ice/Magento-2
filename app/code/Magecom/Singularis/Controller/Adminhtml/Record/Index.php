<?php
/**
 * Copyright © 2016 Magecom
 */

namespace Magecom\Singularis\Controller\Adminhtml\Record;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Backend\App\Action;
use Magento\Framework\Registry;

class Index extends Action
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

        if ($this->getRequest()->getQuery('ajax')) {
            $this->_forward('grid');
            return;
        }

        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $this->_resultPage = $this->_resultPageFactory->create();

        $this->_setTitleMenuBreadcrumbs();

        return $this->_resultPage;
    }

    /**
     * Sets page title, sets active menu, sets breadcrumbs
     */
    protected function _setTitleMenuBreadcrumbs()
    {
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