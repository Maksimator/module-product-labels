<?php

declare(strict_types=1);

namespace Maksimator\ProductLabels\Block\Product;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Catalog\Model\Product;
use Magento\Framework\Registry;
use Magento\Framework\App\ResourceConnection;

class Labels extends Template
{
    public function __construct(
        Context $context,
        private readonly Registry $registry,
        private readonly ResourceConnection $resource,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    public function getLabels(): array
    {
        /** @var Product|null $product */
        $product = $this->registry->registry('current_product');
        if (!$product || !$product->getId()) {
            return [];
        }

        $connection = $this->resource->getConnection();
        $table = $connection->getTableName('maksimator_product_labels');

        $labelIds = $connection->fetchCol(
            $connection->select()
                ->from($table, 'label_id')
                ->where('product_id = ?', $product->getId())
        );

        if (empty($labelIds)) {
            return [];
        }

        $labelTable = $connection->getTableName('maksimator_labels');

        return $connection->fetchAll(
            $connection->select()
                ->from($labelTable)
                ->where('label_id IN (?)', $labelIds)
        );
    }
}
