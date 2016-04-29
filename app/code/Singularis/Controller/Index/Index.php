<?php
/**
 * Copyright © 2016 Magecom
 */

namespace Magecom\Singularis\Controller\Index;

use Magento\Framework\App\Action\Action as OurAction;
use Magento\Framework\App\Action\Context;
use Magento\Framework\ObjectManagerInterface;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Index
 * @package Magecom\Singularis\Controller\Index
 */
class Index extends OurAction
{
    /**
     * @var \Magecom\Singularis\Model\Singularis
     */
    protected $_resultPageFactory;

    /**
     * @var ObjectManagerInterface
     */
    protected $_objectManager;

    /**
     * @param Context $context
     * @param \Magecom\Singularis\Model\Singularis $modelSingularisFactory
     */
    public function __construct(
        Context $context,
        ObjectManagerInterface $objectManager,
        PageFactory $resultPageFactory
    ) {
        $this->_objectManager = $objectManager;
        $this->_resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $page = $this->_resultPageFactory->create();
        $page->getConfig()->getTitle()->set(__('Singularis extension, Index controller, Index action'));

        return $page;
    }
}