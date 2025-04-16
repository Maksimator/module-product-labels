<?php

declare(strict_types=1);

namespace Maksimator\ProductLabels\Controller\Adminhtml\Label;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Result\Page;

class NewAction extends Action
{
    const string ADMIN_RESOURCE = 'Maksimator_ProductLabels::manage';

    public function execute(): Page
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->getConfig()->getTitle()->prepend(__("Add New Product Label"));
        return $resultPage;
    }
}
