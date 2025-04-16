<?php

declare(strict_types=1);

namespace Maksimator\ProductLabels\Model;

use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\ObjectManagerInterface;

class ModelFactory
{
    private DataObjectHelper $dataObjectHelper;
    private ObjectManagerInterface $objectManager;

    public function __construct(
        DataObjectHelper $dataObjectHelper,
        ObjectManagerInterface $objectManager
    ) {
        $this->dataObjectHelper = $dataObjectHelper;
        $this->objectManager = $objectManager;
    }

    public function create(string $className, array $data = []): AbstractModel
    {
        return $this->objectManager->create($className, ['data' => $data]);
    }

    public function createAndPopulateWithArray(string $className, array $data, string $interfaceName = null): void
    {
        $model = $this->create($className);
        $this->dataObjectHelper->populateWithArray($model, $data, $interfaceName?: $className);
    }
}
