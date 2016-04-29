<?php
/**
 * Copyright © 2016 Magecom
 */

namespace Magecom\Singularis\Controller\Adminhtml\Record;

use Magento\Backend\App\Action\Context;
use Magento\Backend\App\Action;
use Magento\Framework\Exception\LocalizedException;

class Save extends Action
{
    /**
     * @var \Magento\Framework\Stdlib\DateTime\DateTime
     */
    protected $_coreDate;

    /**
     * @var \Magento\Framework\Stdlib\DateTime
     */
    protected $_dateTime;

    /**
     * Save constructor.
     * @param Context $context
     * @param \Magento\Framework\Stdlib\DateTime\DateTime $coreDate
     * @param \Magento\Framework\Stdlib\DateTime $dateTime
     */
    public function __construct(
        Context $context,
        \Magento\Framework\Stdlib\DateTime\DateTime $coreDate,
        \Magento\Framework\Stdlib\DateTime $dateTime
    ) {
        $this->_coreDate = $coreDate;
        $this->_dateTime = $dateTime;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();

        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            $id = $this->getRequest()->getParam('record_id');
            /** @var \Magecom\Singularis\Model\Record $model */
            $model = $this->_objectManager->create('Magecom\Singularis\Model\Record')->load($id);
            if (!$model->getId() && $id) {
                $this->messageManager->addError(__('This record no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }
            $model->setData($data);
            // Set date for 'updated at'
            $date = $this->_dateTime->formatDate($this->_coreDate->gmtDate());
            $model->setUpdateTime($date);
            if (!$id && !$model->getCreationTime()) {
                $model->setCreationTime($date);
            }

            $this->_eventManager->dispatch(
                'record_prepare_save',
                ['record' => $model, 'request' => $this->getRequest()]
            );

            try {
                $model->save();
                $this->messageManager->addSuccess(__('Record was saved.'));
                $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['record_id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('An error occurred while saving record.'));
            }

            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/edit', ['post_id' => $this->getRequest()->getParam('record_id')]);
        }
        return $resultRedirect->setPath('*/*/');
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
