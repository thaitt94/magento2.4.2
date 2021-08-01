<?php

namespace Dtn\Ingredient\Model\Config\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;
use Dtn\Ingredient\Model\ResourceModel\Ingredient\CollectionFactory;

class Option extends AbstractSource
{
    protected $ingredientResource;

    public function __construct(
        CollectionFactory $ingredientResource
    )
    {
      $this->ingredientResource = $ingredientResource;
    }

    public function getAllOptions(): ?array
    {
        if (!$this->_options) {
           $ingredients = $this->ingredientResource->create();
            foreach ($ingredients as $ingredient){
                $this->_options = [
                    ['label' => __($ingredient->getName()), 'value' => $ingredient->getId()],
                ];
            }
        }
        return $this->_options;
    }
}
