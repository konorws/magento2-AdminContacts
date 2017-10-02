<?php

namespace Custom\AdminContact\Model\ResourceModel;
 
class Status implements \Magento\Framework\Data\OptionSourceInterface
{

    public function toOptionArray()
    {   
        $options = [];

        $options[0] = 'Not Answered';
        $options[1] = 'Answered';

    
        return $options;
    }
 
}