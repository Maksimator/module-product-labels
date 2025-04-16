<?php

declare(strict_types=1);

namespace Maksimator\ProductLabels\Api\Repository\Data;

use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

interface LabelSearchResultsInterface extends SearchResultsInterface
{
    /**
     * @return LabelInterface[]
     */
    public function getItems(): array;

    /**
     * @param LabelInterface[] $items
     * @return $this
     */
    public function setItems(array $items): static;

    /**
     * @return int
     */
    public function getTotalCount(): int;

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return $this
     */
    public function setSearchCriteria(SearchCriteriaInterface $searchCriteria): static;
}
