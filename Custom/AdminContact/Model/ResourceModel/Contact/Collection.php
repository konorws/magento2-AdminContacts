<?php

namespace Custom\AdminContact\Model\ResourceModel\Contact;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    public function _construct()
    {
        $this->_init('Custom\AdminContact\Model\Contact', 'Custom\AdminContact\Model\ResourceModel\Contact');
    }
}