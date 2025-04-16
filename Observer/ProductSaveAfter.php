<?php

declare(strict_types=1);

namespace Maksimator\ProductLabels\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer as EventObserver;
use Magento\Catalog\Model\Product;
use Magento\Framework\App\ResourceConnection;
use Maksimator\ProductLabels\Ui\DataProvider\Product\Form\Modifier\Labels;

class ProductSaveAfter implements ObserverInterface
{
    public function __construct(
        private readonly ResourceConnection $resource
    ) {}

    public function execute(EventObserver $observer): void
    {
        /** @var Product $product */
        $product = $observer->getEvent()->getProduct();

        if (!$product || !$product->getId()) {
            return;
        }

        $labels = $product->getData(Labels::FIELDSET_CODE);

        if (!is_array($labels)) {
            return;
        }

        $connection = $this->resource->getConnection();
        $table = $connection->getTableName('maksimator_product_labels');

        $connection->delete($table, ['product_id = ?' => $product->getId()]);

        if (!is_array($labels[Labels::FIELD_LABELS])) {
            return;
        }

        foreach ($labels[Labels::FIELD_LABELS] as $labelId) {
            $connection->insert($table, [
                'product_id' => $product->getId(),
                'label_id' => (int)$labelId,
            ]);
        }
    }
}
