<?php

declare(strict_types=1);

namespace Maksimator\ProductLabels\Model;

use Magento\Framework\Model\AbstractModel;
use Maksimator\ProductLabels\Api\Repository\Data\LabelInterface;

class Label extends AbstractModel implements LabelInterface
{
    /**
     * @inheritDoc
     */
    protected function _construct(): void
    {
        $this->_init(ResourceModel\Label::class);
    }

    /**
     * @inheritDoc
     */
    public function getLabelId(): int
    {
        return (int)$this->_getData(self::LABEL_ID);
    }

    /**
     * @inheritDoc
     */
    public function setLabelId(int $labelId): LabelInterface
    {
        return $this->setData(self::LABEL_ID, $labelId);
    }

    /**
     * @inheritDoc
     */
    public function getLabelText(): string
    {
        return (string)$this->_getData(self::LABEL_TEXT);
    }

    /**
     * @inheritDoc
     */
    public function setLabelText(string $labelText): LabelInterface
    {
        return $this->setData(self::LABEL_TEXT, $labelText);
    }

    /**
     * @inheritDoc
     */
    public function getOptions(): ?string
    {
        return (string)$this->_getData(self::LABEL_OPTIONS) ?? null;
    }

    /**
     * @inheritDoc
     */
    public function setOptions(?string $options): LabelInterface
    {
        return $this->setData(self::LABEL_OPTIONS, $options);
    }
}
