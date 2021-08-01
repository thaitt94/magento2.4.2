<?php

namespace Dtn\Ingredient\Ui\Model;

use Magento\Framework\App\Request\DataPersistorInterface;
use Dtn\Ingredient\Model\ResourceModel\Ingredient\CollectionFactory;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Ui\DataProvider\Modifier\PoolInterface;
use Magento\Ui\DataProvider\ModifierPoolDataProvider;

class IngredientProvider extends ModifierPoolDataProvider
{
    const IMAGE_PATH = 'dtn/tmp/ingredient/';
    protected $collection;
    /**
     * @var DataPersistorInterface
     */
    private $dataPersistor;

    /**
     * @var CollectionFactory
     */
    private $collectionFactory;
    protected $loadedData;
    protected $storeManager;
    protected $request;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        DataPersistorInterface $dataPersistor,
        CollectionFactory $collectionFactory,
        RequestInterface $request,
        StoreManagerInterface $storeManager,
        array $meta = [],
        array $data = [],
        PoolInterface $pool = null
    ) {
        $this->collectionFactory = $collectionFactory;
        /**
         * It most important assign ColectionFactoty to collection
         */
        $this->collection  = $collectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        $this->request = $request;
        $this->storeManager = $storeManager;
        parent::__construct(
            $name,
            $primaryFieldName,
            $requestFieldName,
            $meta,
            $data,
            $pool
        );
    }
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        foreach ($items as $ingredient) {
            $this->loadedData[$ingredient->getId()] = $ingredient->getData();
            if ($ingredient->getImage()) {
                $image['image'][0]['type'] = 'image';
                $image['image'][0]['name'] = $ingredient->getImage();
                $image['image'][0]['url'] = $this->storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA).self::IMAGE_PATH.$ingredient->getImage();
                $fullData = $this->loadedData;
                $this->loadedData[$ingredient->getId()] = array_merge($fullData[$ingredient->getId()], $image);
            }
        }
        $data = $this->dataPersistor->get('dtn_ingredient_index');
        if (!empty($data)) {
            $ingredient = $this->collection->getNewEmptyItem();
            $ingredient->setData($data);
            $this->loadedData[$ingredient->getId()] = $ingredient->getData();
            $this->dataPersistor->clear('dtn_ingredient_index');
        }
        return $this->loadedData;
    }
}
