<?php
/**
 * Blackbird Quick Category Save
 *
 * NOTICE OF LICENSE
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to contact@bird.eu so we can send you a copy immediately.
 *
 * @category        Blackbird
 * @package         Blackbird_QuickCategorySave
 * @copyright       Copyright (c) Blackbird (https://black.bird.eu)
 * @author          Thibaud Ritzenthaler (hello@bird.eu)
 * @license         MIT
 * @support         https://github.com/blackbird-agency/magento-2-quick-category-save/issues/new
 */

declare(strict_types=1);

namespace Blackbird\QuickCategorySave\Block\Adminhtml\Category\Edit;


use Magento\Catalog\Block\Adminhtml\Category\AbstractCategory;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;


class QuickSaveButton extends AbstractCategory implements ButtonProviderInterface
{

    /**
     * @inheritDoc
     */
    public function getButtonData(): array
    {
        $category = $this->getCategory();

        if (!$category->isReadonly() && $this->hasStoreRootCategory()) {
            return [
                'label' => __('Quick Save'),
                'class' => 'quicksave secondary',
                'on_click' => $this->triggerSaveButton(),
                'sort_order' => 30,
            ];
        }

        return [];
    }

    /**
     * JavaScript code of the onclick function
     * @return string
     */
    public function triggerSaveButton(): string
    {
        return "const date = new Date();
        date.setTime(date.getTime() + (10*1000));
        document.cookie = 'quick_save=1; expires=' + date.toUTCString() + '; path=/';
        document.getElementById('save').click();";
    }
}
