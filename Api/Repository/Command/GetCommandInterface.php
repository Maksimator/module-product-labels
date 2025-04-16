<?php

declare(strict_types=1);

namespace Maksimator\ProductLabels\Api\Repository\Command;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Model\AbstractModel;

interface GetCommandInterface
{
    /**
     * @param string $id
     * @param string|null $idFieldName
     *
     * @return AbstractModel
     * @throws NoSuchEntityException
     */
    public function get(string $id, string $idFieldName = null): AbstractModel;

    /**
     * @param array $data
     * @return AbstractModel
     * @deprecated
     */
    public function createNewModel(array $data = []): AbstractModel;

    /**
     * @return string
     * @deprecated
     */
    public function getModelClass(): string;
}
