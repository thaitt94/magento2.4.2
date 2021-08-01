<?php

namespace Dtn\Ingredient\Controller\Adminhtml\Ingredient;

use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Backend\App\Action\Context;
use Dtn\Ingredient\Model\IngredientFactory;
use Dtn\Ingredient\Model\ResourceModel\Ingredient;

class Save extends \Magento\Backend\App\Action implements HttpPostActionInterface
{
    const ADMIN_RESOURCE = "Dtn_Ingredient::ingredient";
    private $_ingredientFactory;
    private $ingredientResource;
    public function __construct(
        Context $context,
        IngredientFactory $ingredientFactory,
        Ingredient $ingredientResource
    )
    {
        $this->_ingredientFactory = $ingredientFactory;
        $this->ingredientResource = $ingredientResource;
        parent::__construct($context);
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $data['image'] = $this->_avatar($data);
        $ingredientModel = $this->_ingredientFactory->create();
        $id  = $this->getRequest()->getParam('ingredient_id');
        if($id) {
            $this->ingredientResource->load($ingredientModel, $id);
            if(!$ingredientModel->getId()){
                $this->messageManager->addErrorsMessage(__('Ingredient dose not exits.'));
            }
        }
        $ingredientModel->setName($data['name']);
        $ingredientModel->setColor($data['color']);
        $ingredientModel->setDescription($data['description']);
        $ingredientModel->setImage($data['image']);
        $this->ingredientResource->save($ingredientModel);
        $this->messageManager->addSuccessMessage(__('Ingredient saved successfully.'));
        return $this->_redirect('*/*/');
    }

    public function _avatar(array $rawData)
    {
        //Replace icon with fileuploader field name
        $data = $rawData;
        if (isset($data['image'][0]['name'])) {
            $data['image'] = $data['image'][0]['name'];
        }
        return $data['image'];
    }
}
