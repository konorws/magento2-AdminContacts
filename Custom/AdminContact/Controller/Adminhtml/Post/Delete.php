<?php

namespace Custom\AdminContact\Controller\Adminhtml\Post;

class Delete extends \Magento\Backend\App\AbstractAction
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
                $this->_redirect('admcontact/post/');
                return;
            }
        } else {
            $this->messageManager->addError(__('This post no longer exists.'));
            $this->_redirect('admcontact/post/');
            return;
        }

        try {

            $model->setId($postId);
            $model->delete();
            $this->messageManager->addSuccess(__('You deleted the post.'));
            $this->_redirect('admcontact/post/');
            return;
        } catch (\Exception $e) {
            $this->messageManager->addError($e->getMessage());
            $this->_redirect('adminhtml/*/edit', ['post_id' => $this->getRequest()->getParam('post_id')]);
            return;
        }

        
    }
}
