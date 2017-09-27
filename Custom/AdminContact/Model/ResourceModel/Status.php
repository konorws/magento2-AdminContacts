<?php

namespace Custom\AdminContact\Model\ResourceModel;
 
class Status implements \Magento\Framework\Data\OptionSourceInterface
{

    public function toOptionArray()
    {   
        $options = [];

        $options[0] = [
            'label' => 'Not Answered',
            'value' => 0
        ];

        $options[1] = [
            'label' => 'Answered',
            'value' => 1
        ];

    
        return $options;
    }
 
}