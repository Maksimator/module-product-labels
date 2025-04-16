<?php

declare(strict_types=1);

namespace Maksimator\ProductLabels\Api\Repository\Command;

use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Model\AbstractModel;

interface DeleteCommandInterface
{
    /**
     * @param AbstractModel $model
     *
     * @return void
     * @throws CouldNotDeleteException
     */
    public function delete(AbstractModel $model): void;
}
