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
use Magento\Catalog\Model\CategoryFactory;

class QuickSave
{
    /**
     * @var \Magento\Catalog\Model\CategoryFactory
     */
    private $categoryFactory;

    /**
     * QuickSave constructor.
     * @param \Magento\Catalog\Model\CategoryFactory $categoryFactory
     */
    public function __construct
    (
        CategoryFactory $categoryFactory
    )
    {
        $this->categoryFactory = $categoryFactory;
    }

    public function beforeExecute(Category $subject)
    {
        $writer = new \Laminas\Log\Writer\Stream(BP . '/var/log/test.log');
        $logger = new \Laminas\Log\Logger();
        $logger->addWriter($writer);
        $logger->info('au début');


        $categoryPostData = $subject->getRequest()->getPostValue();

        if (isset($categoryPostData['category_products'])) {
            $categoryPostData['category_products'] = null;
        }
        $logger->info("Before execute{}");

        $subject->getRequest()->setPostValue($categoryPostData);

        return null;
    }
}
