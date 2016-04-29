<?php
/**
 * Copyright © 2016 Magecom
 */

namespace Magecom\Singularis\Observer;

use Magento\Framework\View\Element\Context;
use Magento\Framework\Event\ObserverInterface;

class LayoutRenderBefore implements ObserverInterface
{
    /**
     * @var \Magento\Framework\App\RequestInterface
     */
    protected $_request;

    /**
     * @var \Magento\Framework\View\LayoutInterface
     */
    protected $_layout;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $_logger;

    /**
     * LayoutRenderBefore constructor.
     * @param Context $context
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
        Context $context,
        \Psr\Log\LoggerInterface $logger
    ) {
        $this->_layout = $context->getLayout();
        $this->_request = $context->getRequest();
        $this->_logger = $logger;
    }

    /**
    * @param \Magento\Framework\Event\Observer $observer
    */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $message = __('Layout render before Observer');

        $this->_logger->info($message);
        $this->_logger->error($message);
        $this->_logger->notice($message);
    }
}
