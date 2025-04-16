<?php

declare(strict_types=1);

namespace Maksimator\ProductLabels\Api\Repository\Command;

use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Model\AbstractModel;

interface SaveCommandInterface
{
    /**
     * @param AbstractModel $model
     *
     * @return void
     * @throws CouldNotSaveException
     */
    public function save(AbstractModel $model): void;
}
