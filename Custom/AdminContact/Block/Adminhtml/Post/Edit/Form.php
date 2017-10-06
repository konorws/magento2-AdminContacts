<?php

namespace Custom\AdminContact\Block\Adminhtml\Post\Edit;
 
use \Magento\Backend\Block\Widget\Form\Generic;
 
class Form extends Generic
{
 
    protected $_systemStore;
    protected $_contactFactory;
    protected $_statusModel;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
        \Custom\AdminContact\Model\ContactFactory $contactFactory,
        \Custom\AdminContact\Model\ResourceModel\Status $statusModel,
        array $data = []
    ) {
        $this->_systemStore = $systemStore;
        $this->_statusModel = $statusModel;
        $this->_contactFactory = $contactFactory;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    protected function _construct()
    {
        parent::_construct();
        $this->setId('admincontact_form');
        $this->setTitle(__('Contact Posts'));
    }
 

    protected function _prepareForm()
    {
        $model = $this->_contactFactory->create();
        
        $postId = $this->getRequest()->getParam('post_id');
        $model->load($postId);

        $form = $this->_formFactory->create(
            ['data' => ['id' => 'edit_form', 'action' => $this->getData('action'), 'method' => 'post']]
        );
 
        $form->setHtmlIdPrefix('admcontact_');
 
        $fieldset = $form->addFieldset(
            'base_fieldset',
            ['legend' => __('Post'), 'class' => 'fieldset-wide']
        );
 
        if ($model->getId()) {
            $fieldset->addField('post_id', 'hidden', ['name' => 'post_id']);
        }
 
        $fieldset->addField(
            'name',
            'text',
            ['name' => 'name', 'disabled' => 'disabled' ,'label' => __('Name'), 'title' => __('Name')]
        );

         $fieldset->addField(
            'email',
            'text',
            ['name' => 'email', 'disabled' => 'disabled' ,'label' => __('Email'), 'title' => __('Email')]
        );

        $fieldset->addField(
            'telephone',
            'text',
            ['name' => 'telephone', 'disabled' => 'disabled' ,'label' => __('Telephone'), 'title' => __('Telephone')]
        );

         $fieldset->addField(
            'creation_time',
            'text',
            ['name' => 'creation_time', 'disabled' => 'disabled' ,'label' => __('Time'), 'title' => __('Time')]
        );
 
        $fieldset->addField(
            'comment',
            'textarea',
            ['name' => 'comment', 'style' => 'height:200px;', 'disabled' => 'disabled','label' => __('Comment'), 'title' => __('Comment')]
        );

        $fieldset->addField(
            'status',
            'select',
            [
                'name' => 'status',
                'label' => __('Status'), 
                'title' => __('Status'),
                'options' => $this->_statusModel->toOptionArray()
            ]
        );
        
        $fieldset->addField(
            'sendReply',
            'checkbox',
            ['name' => 'sendReply', 'label' => __('Send Reply'), 'title' => __('Send Reply')]
        );

        $fieldset->addField(
            'answer',
            'textarea',
            ['name' => 'answer', 'style' => 'height:200px;', 'label' => __('Answer'), 'title' => __('Answer')]
        );
 
        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);
 
        return parent::_prepareForm();
    }
}