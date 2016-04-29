<?php
/**
 * Copyright © 2016 Magecom
 */

namespace Magecom\Singularis\Controller\Another;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\ObjectManagerInterface;
use Magento\Framework\View\Result\PageFactory;

class Work extends Action
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
        $page->getConfig()->getTitle()->set(__('Singularis extension, Another controller, Work action'));

        return $page;
    }

    public function execute__old()
    {
        $singularisModel = $this->_objectManager->create('Magecom\Singularis\Model\Singularis');

        // Load the item with ID is 1
        $item = $singularisModel->load(1);
        var_dump($item->getData());

        // Get news collection
        $singularisCollection = $singularisModel->getCollection();
        // Load all data of collection
        var_dump($singularisCollection->getData());
    }
}