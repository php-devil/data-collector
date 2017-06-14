<?php
namespace PhpDevil\Extensions\DataCollector\structure;
use PhpDevil\Extensions\DataCollector\interfaces\IDCBlock;

class DCBlock extends DCBlockPrototype implements IDCBlock
{
    public function isEmpty()
    {
        $empty = true;
        if (!empty($this->_attributes)) foreach($this->_attributes as $a) {
            if (!($a->isEmpty())) {
                $empty = false;
                break;
            }
        }
        return $empty;
    }
}