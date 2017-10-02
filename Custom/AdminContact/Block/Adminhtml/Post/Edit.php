<?php

namespace Custom\AdminContact\Block\Adminhtml\Post;

class Edit extends \Magento\Backend\Block\Widget\Form\Container
{

    protected $_coreRegistry = null;

    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }

    protected function _construct()
    {
        $this->_objectId = 'post_id';
        $this->_blockGroup = 'Custom_AdminContact';
        $this->_controller = 'adminhtml_post';
        parent::_construct();

        $this->buttonList->update('save', 'label', __('Save'));
        $this->buttonList->update('delete', 'label', __('Delete Post'));
        $this->buttonList->remove('reset');

    }
   
    public function getHeaderText()
    {
         return __('Edit Post');
    }
   
    
   
}