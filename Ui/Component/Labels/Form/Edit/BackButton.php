<?php

declare(strict_types=1);

namespace Maksimator\ProductLabels\Ui\Component\Labels\Form\Edit;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class BackButton implements ButtonProviderInterface
{
    public function __construct(
        protected Context $context
    ) {
    }

    public function getButtonData(): array
    {
        return [
            'label' => __('Back'),
            'on_click' => sprintf("location.href = '%s';", $this->getBackUrl('productlabels/label/index')),
            'class' => 'back',
            'sort_order' => 10
        ];
    }

    public function getBackUrl(string $route = '', array $params = []): string
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
