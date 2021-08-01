<?php

namespace Dtn\Ingredient\Setup;

use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    private $eavSetupFactory;

    public function __construct(EavSetupFactory $eavSetupFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'ingredient',
            [
                'type'          => 'varchar',
                'label'         => 'Ingredient',
                'input'         => 'multiselect',
                'source'        => 'Dtn\Ingredient\Model\Config\Source\Option',
                'backend'       => '',
                'sort_order'    => 20,
                'global'        => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                'group'         => '', // If this does not exist, a new group will be created.
                'required'      => false,
                'is_system'     => true,
            ]
        );
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'daily_deal_status',
            [
                'type'                  => 'int',
                'label'                 => 'Daily Deal Status',
                'input'                 => 'select',
                'front_end'             => 'Dtn\Ingredient\Model\Attribute\Frontend\Deal',
                'source'                => 'Dtn\Ingredient\Model\Config\Source\Deal',
                'sort_order'            => '60',
                'global'                => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                'group'                 => 'Daily Deal', // If this does not exist, a new group will be created.
                'required'              => false,
            ]
        );
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'daily_deal_date_start',
            [
                'type'                  => 'datetime',
                'label'                 => 'Daily Deal Date From',
                'input'                 => 'date',
                'source'                => '',
                'sort_order'            => '70',
                'global'                => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                'group'                 => 'Daily Deal', // If this does not exist, a new group will be created.
                'required'              => false,
            ]
        );
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'daily_deal_date_end',
            [
                'type'                  => 'datetime',
                'label'                 => 'Daily Deal Date To',
                'input'                 => 'date',
                'source'                => '',
                'sort_order'            => '80',
                'global'                => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                'group'                 => 'Daily Deal', // If this does not exist, a new group will be created.
                'required'              => false,
            ]
        );
    }
}