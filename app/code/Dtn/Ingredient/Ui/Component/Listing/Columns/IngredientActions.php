<?php

namespace Dtn\Ingredient\Ui\Component\Listing\Columns;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;

class IngredientActions extends Column
{
    /** Url path */
    const EDIT_URL = 'dtn/ingredient/new';
    /** @var UrlInterface */
    protected $_urlBuilder;


    private $_editUrl;

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = [],
        $editUrl = self::EDIT_URL
    )
    {
        $this->_urlBuilder = $urlBuilder;
        $this->_editUrl = $editUrl;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }


    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                $name = $this->getData('name');
                if (isset($item['ingredient_id'])) {
                    $item[$name]['eidt']   = [
                        'href'  => $this->_urlBuilder->getUrl(self::EDIT_URL, ['ingredient_id' => $item['ingredient_id']]),
                        'target' => '_blank',
                        'label' => __('Edit')
                    ];
                }
            }
        }
        return $dataSource;
    }
}