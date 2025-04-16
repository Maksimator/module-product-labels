<?php

namespace Maksimator\ProductLabels\Controller\Adminhtml\Label;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\LocalizedException;
use Maksimator\ProductLabels\Api\Repository\Data\LabelInterface;
use Maksimator\ProductLabels\Model\ResourceModel\Label\CollectionFactory;
use Maksimator\ProductLabels\Api\Repository\LabelRepositoryInterface;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\NotFoundException;
use Magento\Ui\Component\MassAction\Filter;


class MassDelete extends Action implements HttpPostActionInterface
{
    /**
     * Authorization level
     */
    const string ADMIN_RESOURCE = 'Maksimator_ProductLabels::label_delete';

    public function __construct(
        Context $context,
        protected Filter $filter,
        protected CollectionFactory $collectionFactory,
        private readonly LabelRepositoryInterface $labelRepository
    ) {
        parent::__construct($context);
    }

    /**
     * @throws CouldNotDeleteException
     * @throws NotFoundException
     * @throws LocalizedException
     */
    public function execute(): Redirect
    {
        if (!$this->getRequest()->isPost()) {
            throw new NotFoundException(__('Page not found'));
        }
        $collection = $this->filter->getCollection($this->collectionFactory->create());
        $labelDeleted = 0;
        foreach ($collection->getItems() as $label) {
            /** @var LabelInterface $label */
            $this->labelRepository->delete($label);
            $labelDeleted++;
        }

        if ($labelDeleted) {
            $this->messageManager->addSuccessMessage(
                __('A total of %1 record(s) have been deleted.', $labelDeleted)
            );
        }
        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('*/*/index');
    }

}
