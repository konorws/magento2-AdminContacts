<?php

namespace Custom\AdminContact\Controller\Adminhtml\Post;

use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Result\Page;

class Edit extends \Magento\Backend\App\AbstractAction
{   
    protected $_objectManager;
    protected $_coreRegistry;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\ObjectManagerInterface $objectmanager
    ) {
        parent::__construct($context);
        $this->_coreRegistry = $coreRegistry;
        $this->_objectManager = $objectmanager;
    }

    public function execute()
    {
        $postId = $this->getRequest()->getParam('post_id');

        $model = $this->_objectManager->create('Custom\AdminContact\Model\Contact');

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


        $data = $model->getData();
        

        return $this->resultFactory->create();


       
    }
}
