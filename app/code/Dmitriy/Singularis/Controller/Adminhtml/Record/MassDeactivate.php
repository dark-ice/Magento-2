<?php
/**
 * Copyright © 2016 Magecom
 */

namespace Magecom\Singularis\Controller\Adminhtml\Record;

use Magento\Backend\App\Action\Context;
use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;
use Magecom\Singularis\Model\System\Config\State;

class MassDeactivate extends Action
{
    /**
     * MassDeactivate constructor.
     * @param Context $context
     */
    public function __construct(Context $context)
    {
        parent::__construct($context);
    }

    /**
     * MassDeactivate action
     */
    public function execute()
    {
        $recordsIds = $this->getRequest()->getParam('selected');

        if (!is_array($recordsIds)) {
            $this->messageManager->addError(__('Please select records.'));
        } else {
            try {
                foreach ($recordsIds as $recordId) {
                    $model = $this->_objectManager->create('Magecom\Singularis\Model\Record')->load($recordId);
                    $model->setIsActive(State::NOT_ACTIVE);
                    $model->save();
                }
                $this->messageManager->addSuccess(__('Total of %1 record(s) were deactivated.', count($recordsIds)));
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
            }
        }
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setPath('magecom_singularis/record/index');

        return $resultRedirect;
    }

    /**
     * Does the user have access.
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Magecom_Singularis::records');
    }


}