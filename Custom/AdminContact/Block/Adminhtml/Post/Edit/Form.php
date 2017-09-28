<?php
namespace Maxime\Jobs\Block\Adminhtml\Department\Edit;
 
use \Magento\Backend\Block\Widget\Form\Generic;
 
class Form extends Generic
{
 
    protected $_systemStore;
    protected $_objectManager;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
        \Magento\Framework\ObjectManagerInterface $objectmanager,

        array $data = []
    ) {
        $this->_systemStore = $systemStore;
        $this->_objectManager = $objectmanager;
        parent::__construct($context, $registry, $formFactory, $data);
    }
 
    /**
     * Init form
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('department_form');
        $this->setTitle(__('Department Information'));
    }
 
    /**
     * Prepare form
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        $model = $this->_objectManager->create('Custom\AdminContact\Model\Contact');
        
       
        $form = $this->_formFactory->create(
            ['data' => ['id' => 'edit_form', 'action' => $this->getData('action'), 'method' => 'post']]
        );
 
        $form->setHtmlIdPrefix('admcontact_');
 
        $fieldset = $form->addFieldset(
            'base_fieldset',
            ['legend' => __('General Information'), 'class' => 'fieldset-wide']
        );
 
        if ($model->getId()) {
            $fieldset->addField('post_id', 'hidden', ['name' => 'post_id']);
        }
 
        $fieldset->addField(
            'name',
            'text',
            ['name' => 'name', 'label' => __('Department Name'), 'title' => __('Department Name'), 'required' => true]
        );
 
        $fieldset->addField(
            'comment',
            'textarea',
            ['name' => 'comment', 'label' => __('Department Description'), 'title' => __('Department Description'), 'required' => true]
        );
 
        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);
 
        return parent::_prepareForm();
    }
}