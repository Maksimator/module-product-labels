<?php

declare(strict_types=1);

namespace Maksimator\ProductLabels\Model;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Model\AbstractModel;
use Maksimator\ProductLabels\Api\Repository\LabelRepositoryInterface;
use Maksimator\ProductLabels\Model\ResourceModel\Label\Command\Delete;
use Maksimator\ProductLabels\Model\ResourceModel\Label\Command\Get;
use Maksimator\ProductLabels\Model\ResourceModel\Label\Command\GetList;
use Maksimator\ProductLabels\Model\ResourceModel\Label\Command\Save;

readonly class LabelRepository implements LabelRepositoryInterface
{
    public function __construct(
        protected Save $saveCommand,
        protected Get $getCommand,
        protected Delete $deleteCommand,
        protected GetList $getListCommand
    ) {
    }

    public function createNewModel(array $data = []): AbstractModel
    {
        return $this->getCommand->createNewModel($data);
    }

    public function getModelClass(): string
    {
        return $this->getCommand->getModelClass();
    }

    public function delete(AbstractModel $model): void
    {
        $this->deleteCommand->delete($model);
    }

    public function get(string $id, string $idFieldName = null): AbstractModel
    {
        return $this->getCommand->get($id, $idFieldName);
    }

    public function save(AbstractModel $model): void
    {
        $this->saveCommand->save($model);
    }

    public function getList(SearchCriteriaInterface $searchCriteria = null): SearchResultsInterface
    {
        return $this->getListCommand->getList($searchCriteria);
    }
}
