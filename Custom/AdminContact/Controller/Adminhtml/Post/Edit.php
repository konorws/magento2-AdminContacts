<?php

namespace Custom\AdminContact\Controller\Adminhtml\Post;

use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Result\Page;

class Edit extends \Magento\Backend\App\AbstractAction
{   
    protected $_contactFactory;
    protected $_coreRegistry;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Custom\AdminContact\Model\ContactFactory $contactFactory
    ) {
        parent::__construct($context);
        $this->_coreRegistry = $coreRegistry;
        $this->_contactFactory = $contactFactory;
    }

    public function execute()
    {
        $postId = $this->getRequest()->getParam('post_id');

        $model = $this->_contactFactory->create();

        if ($postId) {
            $model->load($postId);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This post no longer exists.'));
                $this->_redirect('*/*/');
                return;
            }
        } else {
            $this->messageManager->addError(__('This post no longer exists.'));
            $this->_redirect('*/*/');
            return;
        }
        

        return $this->resultFactory->create(ResultFactory::TYPE_PAGE);


       
    }
}
