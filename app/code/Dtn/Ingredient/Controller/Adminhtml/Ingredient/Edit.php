<?php

namespace Dtn\Ingredient\Controller\Adminhtml\Ingredient;

use Dtn\Ingredient\Model\IngredientFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;

class Edit extends Action
{
    const ADMIN_RESOURCE = "Dtn_Ingredient::ingredient";
    protected $_pageFactory;
    private $_registry;
    private $_ingredientFactory;

    public function __construct(
        Context $context,
        IngredientFactory $ingredientFactory,
        PageFactory $pageFactory,
        Registry $registry
    )
    {
        $this->_ingredientFactory = $ingredientFactory;
        $this->_pageFactory = $pageFactory;
        $this->_registry = $registry;
        parent::__construct($context);
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('ingredient_id');
        //echo $id;
        $ingredient= $this->_ingredientFactory->create();
        if($id){
            $data = $ingredient->load($id);
            if(!$ingredient->getId()){
                return $this->_redirect('dtn/ingredient/index');
            }
        }
        $this->_registry->register('ingredient',$ingredient);
        $resultPage =$this->_pageFactory->create();
        $resultPage->getConfig()->setKeywords(__('Edit Page'));
        $resultPage->setActiveMenu('Dtn_Ingredient::main_menu');
        $resultPage->getConfig()->getTitle()->prepend('Ingredient');
        if($ingredient->getId()) {
            $pageTitle = __('Edit',$data);
        } else {
            $pageTitle = __('New Ingredient');
        }
        $resultPage->getConfig()->getTitle()->prepend($pageTitle);
        return $resultPage;
    }
}