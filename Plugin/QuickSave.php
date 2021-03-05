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

namespace Blackbird\QuickCategorySave\Plugin;


use Magento\Catalog\Controller\Adminhtml\Category;

class QuickSave
{
    /**
     * Plugin which remove products changes if the quicksave cookie is activated
     * @param \Magento\Catalog\Controller\Adminhtml\Category $subject
     */
    public function beforeExecute(Category $subject): void
    {

        $categoryPostData = $subject->getRequest()->getPostValue();

        if (isset($categoryPostData['category_products'])
            && $subject->getRequest()->getCookie("quick_save", null)) {
            $categoryPostData['category_products'] = null;
        }
        $subject->getRequest()->setPostValue($categoryPostData);

    }
}
