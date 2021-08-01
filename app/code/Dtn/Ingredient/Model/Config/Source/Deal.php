<?php

namespace Dtn\Ingredient\Model\Config\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class Deal extends AbstractSource
{

    public function getAllOptions()
    {
        if (!$this->_options) {
            $this->_options = [
                ['label' => __('Active'), 'value' => 0],
                ['label' => __('Inactive'), 'value' => 1],
            ];
        }
        return $this->_options;
    }
}
