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

namespace Blackbird\QuickCategorySave\Plugin\Catalog\Model\ResourceModel;

use Magento\Framework\App\RequestInterface;

class Category
{
    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * Category constructor.
     *
     * @param RequestInterface $request
     */
    public function __construct(
        RequestInterface $request
    )
    {
        $this->request = $request;
    }

    /**
     * @param \Magento\Catalog\Model\ResourceModel\Category $subject
     * @param \Magento\Catalog\Model\Category $category
     * @return array
     * @throws LocalizedException
     */
    public function beforeSave(
        \Magento\Catalog\Model\ResourceModel\Category $subject,
        \Magento\Catalog\Model\Category $category
    ) {
        if ($this->request->getControllerName() == 'category') {
            if($this->request->getCookie("quick_save", null))
            {
                $category->unsetData('posted_products');
            }
        }

        return [$category];
    }
}
