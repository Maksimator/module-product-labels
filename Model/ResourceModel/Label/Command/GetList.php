<?php

declare(strict_types=1);

namespace Maksimator\ProductLabels\Model\ResourceModel\Label\Command;

use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchCriteriaInterfaceFactory;
use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Maksimator\ProductLabels\Model\ResourceModel\Label\CollectionFactory;
use Maksimator\ProductLabels\Api\Repository\Command\GetListCommandInterface;
use Maksimator\ProductLabels\Api\Repository\Data\LabelSearchResultsInterfaceFactory;

class GetList implements GetListCommandInterface
{
    public function __construct(
        protected CollectionProcessorInterface $collectionProcessor,
        protected SearchCriteriaInterfaceFactory $searchCriteriaFactory,
        protected CollectionFactory $collectionFactory,
        protected LabelSearchResultsInterfaceFactory $labelSearchResultsFactory
    ) {
    }

    public function getList(SearchCriteriaInterface $searchCriteria = null): SearchResultsInterface
    {
        /**
         * @var AbstractCollection $collection
         */
        $searchCriteria = $this->getSearchCriteria($searchCriteria);
        $collection = $this->createCollection($searchCriteria);
        return $this->createSearchResult($searchCriteria, $collection);
    }

    protected function createSearchResult(SearchCriteriaInterface $searchCriteria, $collection): SearchResultsInterface
    {
        $searchResult = $this->labelSearchResultsFactory->create();
        $searchResult->setItems($collection->getItems());
        $searchResult->setTotalCount($collection->getSize());
        $searchResult->setSearchCriteria($searchCriteria);

        return $searchResult;
    }

    protected function getSearchCriteria(SearchCriteriaInterface $searchCriteria = null): SearchCriteriaInterface
    {
        if (is_null($searchCriteria)) {
            $searchCriteria = $this->searchCriteriaFactory->create();
        }

        return $searchCriteria;
    }

    public function createCollection(
        SearchCriteriaInterface $searchCriteria = null
    ): AbstractCollection {
        $collection = $this->collectionFactory->create();
        $searchCriteria = $this->getSearchCriteria($searchCriteria);
        $this->collectionProcessor->process($searchCriteria, $collection);

        return $collection;
    }
}
