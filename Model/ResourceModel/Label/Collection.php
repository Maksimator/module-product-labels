<?php

declare(strict_types=1);

namespace Maksimator\ProductLabels\Model\ResourceModel\Label;

use Exception;
use Magento\Framework\Api\ExtensibleDataInterface;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Api\Search\SearchCriteriaInterface;
use Magento\Framework\Api\Search\AggregationInterface;
use Maksimator\ProductLabels\Api\Repository\Data\LabelInterface;
use Maksimator\ProductLabels\Model\Label;
use Maksimator\ProductLabels\Model\ResourceModel\Label as LabelResource;

class Collection extends AbstractCollection implements SearchResultsInterface
{
    protected $_idFieldName = LabelInterface::LABEL_ID;

    /**
     * @var AggregationInterface
     */
    protected AggregationInterface $aggregations;

    /**
     * @var SearchCriteriaInterface
     */
    protected SearchCriteriaInterface $searchCriteria;

    protected function _construct(): void
    {
        $this->_init(Label::class, LabelResource::class);
    }

    /**
     * @return AggregationInterface
     */
    public function getAggregations(): AggregationInterface
    {
        return $this->aggregations;
    }

    /**
     * @param AggregationInterface $aggregations
     * @return $this
     */
    public function setAggregations(AggregationInterface $aggregations): static
    {
        $this->aggregations = $aggregations;
        return $this;
    }

    /**
     * Get search criteria.
     *
     * @return SearchCriteriaInterface|null
     */
    public function getSearchCriteria(): ?SearchCriteriaInterface
    {
        return $this->searchCriteria;
    }

    /**
     * Set search criteria.
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return $this
     */
    public function setSearchCriteria(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria): static
    {
        $this->searchCriteria = $searchCriteria;
        return $this;
    }

    /**
     * Get total count.
     *
     * @return int
     */
    public function getTotalCount(): int
    {
        return $this->getSize();
    }

    /**
     * Set total count.
     *
     * @param int $totalCount
     * @return $this
     */
    public function setTotalCount($totalCount): static
    {
        return $this;
    }

    /**
     * Set items list.
     *
     * @param ExtensibleDataInterface[] $items
     * @return $this
     * @throws Exception
     */
    public function setItems(array $items = null): static
    {
        if (!$items) {
            return $this;
        }
        foreach ($items as $item) {
            $this->addItem($item);
        }
        return $this;
    }
}
