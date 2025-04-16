<?php

declare(strict_types=1);

namespace Maksimator\ProductLabels\Api\Repository;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Model\AbstractModel;
use Maksimator\ProductLabels\Api\Repository\Command\DeleteCommandInterface;
use Maksimator\ProductLabels\Api\Repository\Command\GetCommandInterface;
use Maksimator\ProductLabels\Api\Repository\Command\GetListCommandInterface;
use Maksimator\ProductLabels\Api\Repository\Command\SaveCommandInterface;

/**
 * @method get(string $id, string $idFieldName = null)
 * @method delete(AbstractModel $model)
 * @method getList(SearchCriteriaInterface $searchCriteria = null)
 * @method save(AbstractModel $model)
 */
interface LabelRepositoryInterface extends DeleteCommandInterface,GetCommandInterface,GetListCommandInterface,SaveCommandInterface
{
}
