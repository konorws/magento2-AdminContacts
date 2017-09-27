<?php

namespace Custom\AdminContact\Controller\Adminhtml\Post;

use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Result\Page;

Class Index extends \Magento\Backend\App\Action
{

    public function execute()
    {
        return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
    }
}

?>