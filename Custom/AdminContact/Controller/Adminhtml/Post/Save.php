<?php

namespace Custom\AdminContact\Controller\Adminhtml\Post;

use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Result\Page;
use Magento\Store\Model\ScopeInterface;


class Save extends \Magento\Backend\App\AbstractAction
{   

    const XML_PATH_EMAIL_RECIPIENT  = 'contact/email/recipient_email';
    const XML_PATH_EMAIL_SENDER     = 'contact/email/sender_email_identity';


    protected $_objectManager;
    protected $_coreRegistry;
    protected $_transportBuilder;
    protected $inlineTranslation;
    protected $scopeConfig;
    protected $storeManager;


    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder,
        \Magento\Framework\Translate\Inline\StateInterface $inlineTranslation,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\ObjectManagerInterface $objectmanager
    ) {
        parent::__construct($context);
        $this->_coreRegistry = $coreRegistry;
        $this->_objectManager = $objectmanager;
        $this->_transportBuilder = $transportBuilder;
        $this->inlineTranslation = $inlineTranslation;
        $this->scopeConfig = $scopeConfig;
        $this->storeManager = $storeManager;
    }

    public function execute()
    {
    	
        $postId = $this->getRequest()->getParam('post_id');

        $model = $this->_objectManager->create('Custom\AdminContact\Model\Contact');

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

        $postData = $model->getData();
        $post = $this->getRequest()->getPostValue();
        $status = (int)$post['status'];

        if(isset($post['sendReply'])){
            $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
            $data = [
                'comment' => $postData['comment'],
                'answer'  => $post['answer']
            ];
            $postObject = new \Magento\Framework\DataObject();
            $postObject->setData($data);
            
            try{
                $transport = $this->_transportBuilder
                    ->setTemplateIdentifier('admincontact_email_template')
                    ->setTemplateOptions(
                        [
                            'area' => \Magento\Backend\App\Area\FrontNameResolver::AREA_CODE,
                            'store' => \Magento\Store\Model\Store::DEFAULT_STORE_ID,
                        ]
                    )
                    ->setTemplateVars(['data' => $postObject])
                    ->setFrom($this->scopeConfig->getValue(self::XML_PATH_EMAIL_SENDER, $storeScope))
                    ->addTo($this->scopeConfig->getValue(self::XML_PATH_EMAIL_RECIPIENT, $storeScope))
                    ->setReplyTo($postData['email'])
                    ->getTransport();

                $transport->sendMessage();
                $status = 1;

                 $this->messageManager->addSuccess(
                    __('Success! You answer sending')
                );
            } catch (\Exception $e) {
                $this->messageManager->addError(
                    __('We can\'t process your request right now. Sorry, that\'s all we know.')
                );
            }
        }


        //Save
        $saveData = [
            'status' => $status,
            'answer' => $post['answer']
        ];

        $model->load($postId)->addData($saveData);
        try {   
            $model->setId($postId)->save();  
            $this->messageManager->addSuccess(
                __('Success! Save data')
            );  
        } catch (Exception $e){  
             $this->messageManager->addError(
                __('Error! Save data')
            ); 
        }  

        $this->_redirect('admcontact/post/');
    }
}

?>