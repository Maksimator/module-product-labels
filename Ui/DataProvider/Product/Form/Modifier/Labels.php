<?php

declare(strict_types=1);

namespace Maksimator\ProductLabels\Ui\DataProvider\Product\Form\Modifier;

use Magento\Ui\DataProvider\Modifier\ModifierInterface;
use Magento\Catalog\Model\Locator\LocatorInterface;
use Magento\Framework\Stdlib\ArrayManager;
use Maksimator\ProductLabels\Model\ResourceModel\Label\CollectionFactory as LabelCollectionFactory;

class Labels implements ModifierInterface
{
    public const string FIELD_LABELS = 'product_labels';
    public const string FIELDSET_CODE = 'product_labels_fieldset';

    public function __construct(
        private readonly LocatorInterface $locator,
        private readonly ArrayManager $arrayManager,
        private readonly LabelCollectionFactory $labelCollectionFactory
    ) {
    }

    public function modifyMeta(array $meta): array
    {
        $meta = $this->arrayManager->merge(
            'product-details/children',
            $meta,
            [
                self::FIELDSET_CODE => [
                    'arguments' => [
                        'data' => [
                            'config' => [
                                'label' => __('Product Labels'),
                                'collapsible' => true,
                                'componentType' => 'fieldset',
                                'sortOrder' => 990,
                                'dataScope' => self::FIELDSET_CODE,
                            ],
                        ],
                    ],
                    'children' => [
                        self::FIELD_LABELS => [
                            'arguments' => [
                                'data' => [
                                    'config' => [
                                        'formElement' => 'multiselect',
                                        'componentType' => 'field',
                                        'label' => __('Assign Labels'),
                                        'dataScope' => self::FIELD_LABELS,
                                        'dataType' => 'text',
                                        'sortOrder' => 10,
                                        'visible' => true,
                                        'options' => $this->getOptions(),
                                        'value' => $this->getSelectedLabels(),
                                        'validation' => [
                                            'required-entry' => false,
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        );

        return $meta;
    }

    public function modifyData(array $data): array
    {
        $product = $this->locator->getProduct();
        $productId = (int)$product->getId();

        if (!$productId) {
            return $data;
        }

        $connection = $product->getResource()->getConnection();
        $table = $connection->getTableName('maksimator_product_labels');

        $selectedLabels = array_map('strval', $connection->fetchCol(
            $connection->select()
                ->from($table, 'label_id')
                ->where('product_id = ?', $productId)
        ));

        $data[$productId][self::FIELDSET_CODE][self::FIELD_LABELS] = $selectedLabels;

        return $data;
    }

    private function getOptions(): array
    {
        $options = [];
        $collection = $this->labelCollectionFactory->create();

        foreach ($collection as $label) {
            $options[] = [
                'label' => $label->getLabelText(),
                'value' => $label->getId()
            ];
        }

        return $options;
    }

    private function getSelectedLabels(): array
    {
        $productId = (int)$this->locator->getProduct()->getId();

        if (!$productId) {
            return [];
        }

        $connection = $this->locator->getProduct()->getResource()->getConnection();
        $table = $connection->getTableName('maksimator_product_labels');

        return array_map('strval', $connection->fetchCol(
            $connection->select()
                ->from($table, 'label_id')
                ->where('product_id = ?', $productId)
        ));
    }
}
