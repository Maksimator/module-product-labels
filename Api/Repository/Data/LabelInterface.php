<?php

declare(strict_types=1);

namespace Maksimator\ProductLabels\Api\Repository\Data;

interface LabelInterface
{
    public const string TABLE_NAME = 'maksimator_labels';
    const string LABEL_ID = 'label_id';
    const string LABEL_TEXT = 'label_text';
    const string LABEL_OPTIONS = 'options';
    /**
     * Get the ID of the label.
     *
     * @return int
     */
    public function getLabelId(): int;

    /**
     * Set the ID of the label.
     *
     * @param int $labelId
     * @return LabelInterface
     */
    public function setLabelId(int $labelId): LabelInterface;

    /**
     * Get the text of the label.
     *
     * @return string
     */
    public function getLabelText(): string;

    /**
     * Set the text of the label.
     *
     * @param string $labelText
     * @return LabelInterface
     */
    public function setLabelText(string $labelText): LabelInterface;

    /**
     * Get the options for the label (stored as JSON).
     *
     * @return string|null
     */
    public function getOptions(): ?string;

    /**
     * Set the options for the label (stored as JSON).
     *
     * @param string|null $options
     * @return LabelInterface
     */
    public function setOptions(?string $options): LabelInterface;
}
