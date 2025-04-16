<?php

declare(strict_types=1);

namespace Maksimator\ProductLabels\Ui\DataProvider;

use Magento\Framework\View\Element\UiComponent\DataProvider\DataProvider;
use Magento\Framework\Api\Search\ReportingInterface;
use Magento\Framework\Api\Search\SearchCriteriaBuilder;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\App\RequestInterface;
use Maksimator\ProductLabels\Model\ResourceModel\Label\CollectionFactory;

class ListingDataProvider extends DataProvider
{
    public function __construct(
        string $name,
        string $primaryFieldName,
        string $requestFieldName,
        ReportingInterface $reporting,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        RequestInterface $request,
        FilterBuilder $filterBuilder,
        private readonly CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct(
            $name,
            $primaryFieldName,
            $requestFieldName,
            $reporting,
            $searchCriteriaBuilder,
            $request,
            $filterBuilder,
            $meta,
            $data
        );
    }

    public function getData(): array
    {
        $collection = $this->collectionFactory->create();

        $searchCriteria = $this->getSearchCriteria();
        if ($searchCriteria) {
            foreach ($searchCriteria->getFilterGroups() as $filterGroup) {
                foreach ($filterGroup->getFilters() as $filter) {
                    $condition = $filter->getConditionType() ?: 'eq';
                    $collection->addFieldToFilter($filter->getField(), [$condition => $filter->getValue()]);
                }
            }
        }

        $items = [];
        foreach ($collection->getItems() as $item) {
            $itemData = $item->getData();

            if (isset($itemData['options']) && is_string($itemData['options'])) {
                $options = json_decode($itemData['options'], true);
                if (is_array($options)) {
                    $itemData['color'] = $options['Color'] ?? '';
                    $itemData['css_class'] = $options['CssClassName'] ?? '';
                    $itemData['inline_css'] = $options['InlineCss'] ?? '';
                    $itemData['is_active'] = (bool)($options['IsActive'] ?? false) ? '1' : '0';
                }
                unset($itemData['options']);
            }

            $items[] = $itemData;
        }

        return [
            'items' => $items,
            'totalRecords' => $collection->getSize()
        ];
    }
}
