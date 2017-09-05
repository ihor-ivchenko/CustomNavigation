<?php
namespace BlottedScience\CustomNavigation\Model;

use Magento\Catalog\Model\Layer as CoreLayer;
use Magento\Catalog\Model\Layer\ContextInterface;
use Magento\Catalog\Model\Layer\StateFactory;
use Magento\Catalog\Model\ResourceModel\Product\Attribute\CollectionFactory as AttributeCollectionFactory;
use Magento\Catalog\Model\ResourceModel\Product;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Registry;
use Magento\Catalog\Api\CategoryRepositoryInterface;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;

class Layer extends CoreLayer
{
    //Apart from the default construct argument you need to add your model from which your product collection is fetched.
    /**
     * @var CollectionFactory
     */
    protected $_productCollectionFactory;

    /**
     * Layer constructor.
     * @param ContextInterface $context
     * @param StateFactory $layerStateFactory
     * @param AttributeCollectionFactory $attributeCollectionFactory
     * @param Product $catalogProduct
     * @param StoreManagerInterface $storeManager
     * @param Registry $registry
     * @param CategoryRepositoryInterface $categoryRepository
     * @param CollectionFactory $productCollectionFactory
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        StateFactory $layerStateFactory,
        AttributeCollectionFactory $attributeCollectionFactory,
        Product $catalogProduct,
        StoreManagerInterface $storeManager,
        Registry $registry,
        CategoryRepositoryInterface $categoryRepository,
        CollectionFactory $productCollectionFactory,
        array $data = []
    ) {
        $this->_productCollectionFactory = $productCollectionFactory;
        parent::__construct(
            $context,
            $layerStateFactory,
            $attributeCollectionFactory,
            $catalogProduct,
            $storeManager,
            $registry,
            $categoryRepository,
            $data
        );
    }

    public function getProductCollection()
    {

        /*
         * Unique id is needed so that when product is loaded /filtered in the custom listing page it will be set in the
         * $this->_productCollections array with unique key else you will not get the updated or proper collection.
        */
        if (isset($this->_productCollections['custom_navigation_collection'])) {
            $collection = $this->_productCollections['custom_navigation_collection'];
        } else {
            /* Custom logic for your custom entity collection*/
            $collection = $this->_productCollectionFactory->create();
            $collection->addAttributeToSelect('*');

            $this->prepareProductCollection($collection);
            $this->_productCollections['custom_navigation_collection'] = $collection;
        }

        return $collection;
    }
}