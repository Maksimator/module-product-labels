<?php

declare(strict_types=1);

namespace Maksimator\ProductLabels\Model\ResourceModel\Label\Command;

use Exception;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Model\AbstractModel;
use Maksimator\ProductLabels\Model\ResourceModel\Label as ResourceModel;
use Maksimator\ProductLabels\Api\Repository\Command\SaveCommandInterface;

class Save implements SaveCommandInterface
{
    public function __construct(
        protected ResourceModel $resource
    ) {
    }

    /**
     * @inheirtDoc
     */
    public function save(AbstractModel $model): void
    {
        try {
            $this->resource->save($model);
        } catch (Exception $e) {
            throw new CouldNotSaveException(__('Could not save item.'), $e);
        }
    }
}
