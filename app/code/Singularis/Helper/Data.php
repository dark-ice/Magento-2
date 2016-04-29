<?php
/**
 * @author Bob Smith
 * @copyright Copyright (c) 2016 Magecom
 * @package Magecom_Singularis
 */
namespace Magecom\Singularis\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterfac
     */
    protected $_scopeConfig;

    CONST ENABLE      = 'magecom_singularis/general/enable';
    CONST BLOCK_LABEL = 'magecom_singularis/general/block_label';
    CONST TEXT_ALIGN  = 'magecom_singularis/general/text_align';

    /**
     * Data constructor.
     * @param \Magento\Framework\App\Helper\Context $context
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    ) {
        parent::__construct($context);

        $this->_scopeConfig = $scopeConfig;
    }

    /**
     * @return string
     */
    public function getEnable(){
        return $this->_scopeConfig->getValue(self::ENABLE);
    }

    /**
     * @return string
     */
    public function getLabel(){
        return $this->_scopeConfig->getValue(self::BLOCK_LABEL);
    }

    /**
     * @return string
     */
    public function getTextAlign(){
        return $this->_scopeConfig->getValue(self::TEXT_ALIGN);
    }
}