<?php

declare(strict_types=1);

namespace Maksimator\ProductLabels\Model\ResourceModel\Label\Command;

use Exception;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Model\AbstractModel;
use Maksimator\ProductLabels\Model\ResourceModel\Label as ResourceModel;
use Maksimator\ProductLabels\Api\Repository\Command\DeleteCommandInterface;

class Delete implements DeleteCommandInterface
{
    public function __construct(
        protected ResourceModel $resource
    ) {
    }

    /**
     * @throws CouldNotDeleteException
     */
    public function delete(AbstractModel $model): void
    {
        try {
            $this->resource->delete($model);
        } catch (Exception $e) {
            throw new CouldNotDeleteException(__('Could not delete item.'), $e);
        }
    }
}
