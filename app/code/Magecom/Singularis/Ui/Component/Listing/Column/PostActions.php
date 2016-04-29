<?php
/**
 * Copyright © 2016 Magecom
 */

namespace Magecom\Singularis\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;

/**
 * Class PostActions
 * @package Magecom\Singularis\Ui\Component\Listing\Column
 */
class PostActions extends Column
{
    /** Url path */
    const RECORD_URL_PATH_EDIT = 'magecom_singularis/record/edit';
    const RECORD_URL_PATH_DELETE = 'magecom_singularis/record/delete';

    /** @var UrlInterface */
    protected $_urlInterface;

    /**
     * @var string
     */
    private $_editUrl;

    /**
     * PostActions constructor.
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlInterface $_urlInterface
     * @param array $components
     * @param array $data
     * @param string $editUrl
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $_urlInterface,
        array $components = [],
        array $data = [],
        $editUrl = self::RECORD_URL_PATH_EDIT
    ) {
        $this->_urlInterface = $_urlInterface;
        $this->_editUrl = $editUrl;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $name = $this->getData('name');
                if (isset($item['record_id'])) {
                    $item[$name]['edit'] = [
                        'href' => $this->_urlInterface->getUrl($this->_editUrl, ['record_id' => $item['record_id']]),
                        'label' => __('Edit')
                    ];
                    $item[$name]['delete'] = [
                        'href' => $this->_urlInterface->getUrl(self::RECORD_URL_PATH_DELETE, ['record_id' => $item['record_id']]),
                        'label' => __('Delete'),
                        'confirm' => [
                            'title' => __('Delete "${ $.$data.title }"'),
                            'message' => __('Are you sure you want to delete a "${ $.$data.title }" record?')
                        ]
                    ];
                }
            }
        }

        return $dataSource;
    }
}
