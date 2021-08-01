<?php

namespace Dtn\Ingredient\Model\ResourceModel\Ingredient;

/*
 * Class tạo ra một collection cho module
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'ingredient_id';

    protected function _construct()
    {
        $this->_init(\Dtn\Ingredient\Model\Ingredient::class,
            \Dtn\Ingredient\Model\ResourceModel\Ingredient::class);
    }

}
