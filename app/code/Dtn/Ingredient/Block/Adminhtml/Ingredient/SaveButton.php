<?php

namespace Dtn\Ingredient\Block\Adminhtml\Ingredient;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class SaveButton extends GenericButton implements ButtonProviderInterface
{

    public function getButtonData(): array
    {
       $data = [
                'label' => __('Save'),
                'class' => 'save primary',
                'on_click' => '',
            ];
        return $data;
    }
}
