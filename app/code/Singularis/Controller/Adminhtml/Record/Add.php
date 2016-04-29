<?php
/**
 * Copyright © 2016 Magecom
 */

namespace Magecom\Singularis\Controller\Adminhtml\Record;

use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\ForwardFactory;
use Magento\Backend\App\Action;

class Add extends Action
{
    /**
     * @var ForwardFactory
     */
    protected $_forwardFactory;

    /**
     * Add constructor.
     * @param Context $context
     * @param ForwardFactory $forwardFactory
     */
    public function __construct(
        Context $context,
        ForwardFactory $forwardFactory
    ) {
        $this->_forwardFactory = $forwardFactory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Backend\Model\View\Result\Forward
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Forward $forward */
        $forward = $this->_forwardFactory->create();

        return $forward->forward('edit');
    }

    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Magecom_Singularis::records');
    }


}