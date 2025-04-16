<?php

declare(strict_types=1);

namespace Maksimator\ProductLabels\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Maksimator\ProductLabels\Api\Repository\Data\LabelInterface;

class Label extends AbstractDb
{
    public const string TABLE_NAME = 'maksimator_labels';
    public const string ID = 'label_id';

    protected function _construct(): void
    {
        $this->_init(LabelInterface::TABLE_NAME, LabelInterface::LABEL_ID);
    }
}
