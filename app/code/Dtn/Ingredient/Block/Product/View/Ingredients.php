<?php

namespace Dtn\Ingredient\Block\Product\View;

use Dtn\Ingredient\Model\IngredientFactory;
use Dtn\Ingredient\Model\ResourceModel\Ingredient\CollectionFactory;

class Ingredients extends \Magento\Framework\View\Element\Template
{
    protected $_registry;
    protected $ingredientFactory;
    protected $ingredientResource;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        IngredientFactory $ingredientFactory,
        CollectionFactory $ingredientResource,
        \Magento\Framework\Registry $registry,
        array $data = []
    )
    {
        $this->ingredientFactory = $ingredientFactory;
        $this->ingredientResource = $ingredientResource;
        $this->_registry = $registry;
        parent::__construct($context, $data);
    }

    public function _prepareLayout()
    {
        return parent::_prepareLayout();
    }

    public function getCurrentProduct()
    {
        return $this->_registry->registry('current_product');
    }

    public function getCurrentProductattribute()
    {
        $data =  $this->getCurrentProduct();
        $ingredient_id = (explode(",", $data->getIngredient()));
        return $ingredient_id;
    }

    public function getIngredientById()
    {
        $ingredient = $this->ingredientResource->create()
        ->addFieldToFilter('ingredient_id', array('in' => array($this->getCurrentProductattribute())))
        ->getData();
        return $ingredient;
    }

    public function getlist() {
        return $this->ingredientResource->create();
    }
}
