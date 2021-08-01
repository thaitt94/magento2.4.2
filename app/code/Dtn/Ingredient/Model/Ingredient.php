<?php

namespace Dtn\Ingredient\Model;

class Ingredient extends \Magento\Framework\Model\AbstractModel
{
    protected function _construct()
    {
        $this->_init(\Dtn\Ingredient\Model\ResourceModel\Ingredient::class);
    }
}
