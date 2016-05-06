<?php
namespace Dmitriy\TestDiscount\Helper;
/**
 * Class Data
 * @package Dmitriy\TestDiscount\Helper
 */
class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterfac
     */
    protected $_scopeConfig;
    /**
     * @var \Magento\Sales\Model\ResourceModel\Order\CollectionFactory
     */
    protected $_orderCollectionFactory;
    /**
     *
     */
    CONST ENABLE         = 'dmitriy_testdiscount/general/enable';
    /**
     *
     */
    CONST DISCOUNT_LIMIT = 'dmitriy_testdiscount/general/discount_limit';
    /**
     *
     */
    CONST DISCOUNT_STEP  = 'dmitriy_testdiscount/general/discount_step';

    /**
     * Data constructor.
     * @param \Magento\Framework\App\Helper\Context $context
     * @param \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $orderCollectionFactory
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $orderCollectionFactory,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    ) {
        parent::__construct($context);
        $this->_orderCollectionFactory = $orderCollectionFactory;
        $this->_scopeConfig = $scopeConfig;
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
     * @return string
     */
    public function getEnable()
    {
        return $this->_scopeConfig->getValue(self::ENABLE);
    }
    /**
     * @return string
     */
    public function getDiscountLimit()
    {
        return $this->_scopeConfig->getValue(self::DISCOUNT_LIMIT);
    }
    /**
     * @return string
     */
    public function getDiscountStep()
    {
        return $this->_scopeConfig->getValue(self::DISCOUNT_STEP);
    }
    /**
     * get orders data
     *
     * @param $customerId
     * @return array
     */
    public function getOrderData($customerId)
    {
        $orderData = array();
        $total = 0;
        $orderCollection = $this->_orderCollectionFactory;
        $orderCollectionLoaded = $orderCollection
            ->create()
            ->addFieldToFilter(array('customer_id'),  array(array('eq' => $customerId)));
        foreach ($orderCollectionLoaded->getData() as $order) {
            $total += $order['grand_total'];
        }
        $percent = $this->getPercentOfDiscount($total);
        $orderData['count'] = $orderCollectionLoaded->count();
        $orderData['total'] = $total;
        $orderData['discount'] = $percent;
        return $orderData;
    }
    /**
     * @param $total
     * @return int
     */
    public function getPercentOfDiscount($total)
    {
        $percent = 0;
        $limit = (int) $this->getDiscountLimit();
        $discountStep = (float) $this->getDiscountStep();
        if ($discountStep > 0) {
            $percent = (int) ($total / $discountStep);
            if ($percent > $limit) {
                $percent = $limit;
            }
        }
        return $percent;
    }
    /**
     * get value of discount bases on basesaubtotal asd discount percent in cart
     *
     * @param $customerId
     * @param $baseSubtotal
     * @return float
     */
    public function getValueOfDiscount($customerId, $baseSubtotal)
    {
        $orderData = $this->getOrderData($customerId);
        return (float) ('-' . ($baseSubtotal*$orderData['discount']/100));
    }
}
