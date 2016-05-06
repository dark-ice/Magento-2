<?php
namespace Dmitriy\TestDiscount\Block;
use Magento\Framework\View\Element\Template;

/**
 * Class Main
 * @package Dmitriy\TestDiscount\Block
 */
class Main extends Template
{
    /**
     * @var \Dmitriy\TestDiscount\Helper\Data
     */
    protected $_helper;
    /**
     * @var \Magento\Sales\Model\ResourceModel\Order\CollectionFactory
     */
    protected $_orderCollectionFactory;
    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;
    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $orderCollectionFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $orderCollectionFactory,
        \Dmitriy\TestDiscount\Helper\Data $helper,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        array $data = []
    ) {
        $this->_storeManager = $storeManager;
        $this->_helper = $helper;
        $this->_orderCollectionFactory = $orderCollectionFactory;
        parent::__construct($context, $data);
        $this->_isScopePrivate = true;
    }
    /**
     * @return array
     */
    protected function _construct()
    {
        parent::_construct();
        $this->_orderCollectionFactory->create()->addAttributeToSelect('*');
    }
    /**
     * get customer data about orders and totals
     *
     * @return array
     */
    public function getCustomerData()
    {
        $customerData['is_login'] = false;
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $customerSession = $objectManager->get('Magento\Customer\Model\Session');
        $customer = $customerSession->getCustomer();
        if ($customerSession->isLoggedIn()) {
            $orderData = $this->_helper->getOrderData($customer->getId());
            $customerData['count'] = $orderData['count'];
            $customerData['total'] = $orderData['total'];
            $customerData['discount'] = $orderData['discount'];
            $customerData['is_login'] = true;
            $customerData['name'] = $customer->getName();
        }
        return $customerData;
    }
    /**
     * get base url
     */
    public function getBaseUrl()
    {
        $this->_storeManager->getStore()->getBaseUrl();
    }
}