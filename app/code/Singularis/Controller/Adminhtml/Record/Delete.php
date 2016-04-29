<?php
/**
 * Copyright © 2016 Magecom
 */

namespace Magecom\Singularis\Controller\Adminhtml\Record;

use Magento\Backend\App\Action\Context;
use Magento\Backend\App\Action;

class Delete extends Action
{
    /**
     * Delete constructor.
     * @param Context $context
     */
    public function __construct(Context $context)
    {
        parent::__construct($context);
    }

    /**
     * Delete action
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('record_id');

        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            try {
                $model = $this->_objectManager->create('Magecom\Singularis\Model\Record');
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccess(__('The record has been deleted.'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['record_id' => $id]);
            }
        }
        $this->messageManager->addError(__('No record found.'));
        return $resultRedirect->setPath('*/*/');
    }

    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Magecom_Singularis::records');
    }
}