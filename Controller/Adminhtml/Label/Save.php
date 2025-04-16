<?php

declare(strict_types=1);

namespace Maksimator\ProductLabels\Controller\Adminhtml\Label;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;
use Maksimator\ProductLabels\Model\LabelFactory;
use Maksimator\ProductLabels\Api\Repository\LabelRepositoryInterface;

class Save extends Action
{
    const string ADMIN_RESOURCE = 'Maksimator_ProductLabels::manage';
    public function __construct(
        Context $context,
        protected LabelFactory $labelFactory,
        protected LabelRepositoryInterface $labelRepository
    ) {
        parent::__construct($context);
    }

    public function execute(): ResultInterface|ResponseInterface|Redirect
    {
        $resultRedirect = $this->resultRedirectFactory->create();

        if (!$this->getRequest()->isPost()) {
            return $resultRedirect->setPath('*/*/');
        }

        $data = $this->getRequest()->getPostValue();

        try {
            $id = isset($data['label_id']) ? (int)$data['label_id'] : null;
            $model = $id ? $this->labelRepository->get((string) $id) : $this->labelFactory->create();

            $options = [
                'IsActive' => isset($data['is_active']) && (bool)$data['is_active'],
                'Color' => $data['color'] ?? '',
                'CssClassName' => $data['css_class'] ?? '',
                'InlineCss' => $data['inline_css'] ?? ''
            ];
            $model->setLabelText($data['label_text'] ?? '');
            $model->setOptions(json_encode($options));

            $this->labelRepository->save($model);
            $this->messageManager->addSuccessMessage(__('You saved the label.'));

            if ($this->getRequest()->getParam('back')) {
                return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId()]);
            }

            return $resultRedirect->setPath('*/*/');
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the label.'));
        }

        return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
    }
}
