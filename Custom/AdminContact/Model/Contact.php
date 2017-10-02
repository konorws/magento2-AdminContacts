<?php

namespace Custom\AdminContact\Model;

use Magento\Cron\Exception;
use Magento\Framework\Model\AbstractModel;

class Contact extends AbstractModel
{

    protected function _construct()
    {
        $this->_init(\Custom\AdminContact\Model\ResourceModel\Contact::class);
    }
    
}