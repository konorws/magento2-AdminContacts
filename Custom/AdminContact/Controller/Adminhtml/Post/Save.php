<?php

namespace Custom\AdminContact\Controller\Adminhtml\Post;

use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Result\Page;

Class Save extends \Magento\Backend\App\Action
{

    public function execute()
    {
    	$post = $this->getRequest()->getPostValue();

        $this->inlineTranslation->suspend();
        
        if((int)$post['post_id'] < 1 OR 1 == 1){
        	 $this->inlineTranslation->resume();
        	 $this->messageManager->addError(
                __('Error. Invalid value post_id');
            );
        	$this->_redirect('/admcontact/post/');
        }


    }
}

?>