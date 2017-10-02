<?php

namespace Custom\AdminContact\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Contact extends AbstractDb
{

    public function _construct()
    {
        $this->_init('contact_posts', 'post_id');
    }
}