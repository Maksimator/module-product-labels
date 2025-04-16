<?php

declare(strict_types=1);

namespace Maksimator\ProductLabels\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class ProductLabel extends AbstractDb
{
    protected function _construct(): void
    {
        $this->_init('maksimator_product_labels', null);
    }
}
