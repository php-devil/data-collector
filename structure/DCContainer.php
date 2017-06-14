<?php
namespace PhpDevil\Extensions\DataCollector\structure;
use PhpDevil\Extensions\DataCollector\DCForm;
use PhpDevil\Extensions\DataCollector\interfaces\IDCBlock;

class DCContainer extends DCContainerPrototype implements IDCBlock
{
    public function render($display = DCForm::MODE_RETURN)
    {
        if (empty($this->_attributes)) {
            $this->_attributes[0] = $this->createAttribute(0);
        }
        $innerHtml = '';
        if (is_array($this->_attributes)) foreach($this->_attributes as $obj){
            $innerHtml .= $obj->render();
        }
        ob_start();
        include $this->_template;
        if (DCForm::MODE_RETURN == $display) {
            return ob_get_clean();
        } else {
            echo ob_get_clean();
        }
    }
    
    public function renderMultiple($minimalRows)
    {
        $total = count($this->_attributes);
        while($total < $minimalRows) {
            $this->_attributes[$total] = $this->createAttribute($total);
            ++$total;
        }
        return $this->render();
    }
}