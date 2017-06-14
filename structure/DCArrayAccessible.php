<?php
namespace PhpDevil\Extensions\DataCollector\structure;

abstract class DCArrayAccessible implements \ArrayAccess
{
    public function offsetExists($offset)
    {
        return isset($this->_attributes[$offset]);
    }
    public function offsetGet($offset)
    {
        return $this->offsetExists($offset) ? $this->_attributes[$offset] : null;
    }
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->_attributes[] = $value;
        } else {
            $this->_attributes[$offset] = $value;
        }
    }
    public function isEmptyArguments($var)
    {
        if (is_array($var)) foreach($var as $k=>$v) {
            if (!empty($v)) return false;
        } else {
            return empty($var);
        }
        return true;
    }
    public function offsetUnset($offset)
    {
        unset($this->_attributes[$offset]);
    }
}