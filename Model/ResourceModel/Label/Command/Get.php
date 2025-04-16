<?php

declare(strict_types=1);

namespace Maksimator\ProductLabels\Model\ResourceModel\Label\Command;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Model\AbstractModel;
use Maksimator\ProductLabels\Model\ModelFactory;
use Maksimator\ProductLabels\Api\Repository\Data\LabelInterface;
use Maksimator\ProductLabels\Model\ResourceModel\Label as ResourceModel;
use Maksimator\ProductLabels\Api\Repository\Command\GetCommandInterface;

class Get implements GetCommandInterface
{
    public function __construct(
        protected ModelFactory $modelFactory,
        protected ResourceModel $resource,
        protected string $modelClass = LabelInterface::class
    ) {
    }

    public function get(string $id, string $idFieldName = null): AbstractModel
    {
        $model = $this->createNewModel();
        $this->resource->load($model, $id, $idFieldName);

        if (null === $model->getId()) {
            throw new NoSuchEntityException(
                __(
                    'Item with "%id" "%value" does not exist.',
                    ['value' => $id, 'id' => $idFieldName ?: $model->getIdFieldName()]
                )
            );
        }
        return $model;
    }

    public function createNewModel(array $data = []): AbstractModel
    {
        return $this->modelFactory->create($this->modelClass, $data);
    }

    public function getModelClass(): string
    {
        return $this->modelClass;
    }
}
