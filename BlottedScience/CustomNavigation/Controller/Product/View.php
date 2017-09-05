<?php

namespace BlottedScience\CustomNavigation\Controller\Product;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Catalog\Model\Layer\Resolver;

class View extends Action
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var Resolver
     */
    protected $layerResolver;

    /**
     * Crud constructor.
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param Resolver $layerResolver
     */
    public function	__construct(
        Context	$context,
        PageFactory $resultPageFactory,
        Resolver $layerResolver
    )
    {
        $this->resultPageFactory = $resultPageFactory;
        $this->layerResolver = $layerResolver;
        return	parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\View\Result\Page
     */
    public function	execute()
    {
        $this->layerResolver->create('customlayer');
        $resultPage	= $this->resultPageFactory->create();

        return	$resultPage;
    }
}