<?php

declare(strict_types=1);

namespace Maksimator\ProductLabels\Controller\Adminhtml\Label;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Maksimator\ProductLabels\Api\Repository\LabelRepositoryInterface;
use Magento\Framework\Exception\CouldNotDeleteException;

class Delete extends Action
{
    const string ADMIN_RESOURCE = 'Maksimator_ProductLabels::label_delete';

    public function __construct(
        Context $context,
        protected LabelRepositoryInterface $labelRepository
    ) {
        parent::__construct($context);
    }

    public function execute(): ResultInterface|ResponseInterface|Redirect
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $id = $this->getRequest()->getParam('id');

        if ($id) {
            try {
                $labelModel = $this->labelRepository->get($id);
                $this->labelRepository->delete($labelModel);
                $this->messageManager->addSuccessMessage(__('The label has been deleted.'));
                return $resultRedirect->setPath('*/*/');
            } catch (CouldNotDeleteException|NoSuchEntityException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                return $resultRedirect->setPath('*/*/');
            }
        }

        $this->messageManager->addErrorMessage(__('We can\'t find a label to delete.'));
        return $resultRedirect->setPath('*/*/');
    }
}
