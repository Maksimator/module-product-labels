<?php

declare(strict_types=1);

namespace Maksimator\ProductLabels\Controller\Adminhtml\Label;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;
use Maksimator\ProductLabels\Api\Repository\LabelRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;

class Edit extends Action
{
    public function __construct(
        Context $context,
        protected PageFactory $resultPageFactory,
        protected LabelRepositoryInterface $labelRepository
    ) {
        parent::__construct($context);
    }

    public function execute(): Page|ResultInterface|ResponseInterface|Redirect
    {
        $id = $this->getRequest()->getParam('label_id');
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Maksimator_ProductLabels::manage');

        if ($id) {
            try {
                $label = $this->labelRepository->getById((int)$id);
                $resultPage->getConfig()->getTitle()->prepend(__('Edit Label: %1', $label->getTitle()));
            } catch (NoSuchEntityException $e) {
                $this->messageManager->addErrorMessage(__('This label no longer exists.'));
                return $this->resultRedirectFactory->create()->setPath('*/*/');
            }
        } else {
            $resultPage->getConfig()->getTitle()->prepend(__('New Label'));
        }

        return $resultPage;
    }

    protected function _isAllowed(): bool
    {
        return $this->_authorization->isAllowed('Maksimator_ProductLabels::productlabels');
    }
}
