<?php

declare(strict_types=1);

namespace Maksimator\ProductLabels\Ui\DataProvider\Labels\Listing;

use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;

class Collection extends SearchResult
{
    /**
     * Override _initSelect to add custom columns
     *
     * @return void
     */
    protected function _initSelect(): void
    {
        $this->addFilterToMap('entity_id', 'main_table.label_id');
        parent::_initSelect();
    }
}
