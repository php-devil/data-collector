<?php
namespace PhpDevil\Extensions\DataCollector\structure;


use PhpDevil\Extensions\DataCollector\DCForm;

abstract class DCEntityPrototype extends DCArrayAccessible
{
    protected $_owner = null;
    protected $_name  = null;

    protected $_value = null;
    protected $_variants = null;
    protected $_default = null;

    protected $_template = null;

    protected $_isDefaultValue = false;

    protected $_htmlName = null;
    protected $_htmlID = null;

    protected $status = 'none';
    protected $message = [];

    public function isEmpty()
    {
        $value = $this->getValue();
        return empty($value);
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setMessage($message)
    {
        $this->message[] = $message;
    }

    public function getMessage($merge = null)
    {
        if (null === $merge) {
            return $this->message;
        } else {
            return implode($merge, $this->message);
        }
    }

    public function getName()
    {
        if (null === $this->_htmlName) {
            if (is_object($this->_owner) && $ownerName = $this->_owner->getName()) {
                $this->_htmlName = $ownerName . '[' . $this->_name . ']';
            } else {
                $this->_htmlName = $this->_name;
            }
        }
        return $this->_htmlName;
    }

    public function getID()
    {
        if (null ===$this->_htmlID) {
            $name = $this->getName();
            $this->_htmlID = str_replace(']', '', str_replace('[', '_', $name));
        }
        return $this->_htmlID;
    }

    public function getValue($valueOnVariant = true)
    {
        if ($valueOnVariant && isset($this->_variants[$this->_value])) {
            return $this->_variants[$this->_value];
        } else {
            return $this->_value;
        }
    }

    public function setDefaultValue($value)
    {
        if ($this->_isDefaultValue || null === $this->_value) {
            $this->_value = $value;
            if (null === $this->_value) {
                $this->_isDefaultValue = true;
            }
        }
    }

    /**
     * Эеспорт атрибутов в массив
     *
     * @param bool $valueOnVariant
     * @return array
     */
    public function export($valueOnVariant = false)
    {
        if ($this instanceof DCEntityPrototype) {
            return $this->getValue($valueOnVariant);
        } else {
            $arr = [];
            if (is_array($this->_attributes)) foreach($this->_attributes as $k=>$v) {
                $arr[$k] = $v->export($valueOnVariant);
            }
            return $arr;
        }
    }

    public function applyAttributes($data, $saveMode = DCForm::SAVE_NONE)
    {
        $this->_value = filter_var($data, FILTER_DEFAULT);
        $this->_isDefaultValue = false;
    }

    public function __construct($config = [], $owner, $name)
    {
        $this->_name = $name;
        $this->_owner = $owner;
        if (isset($config['variants'])) {
            $this->_variants = $config['variants'];
        }
        if (null === $this->_value && isset($config['default'])) {
            $this->_value = $config['default'];
            $this->_isDefaultValue = true;
        }
        if (isset($config['template'])) {
            $this->_template = $config['template'];
        }
        $this->setDefaultsOnConstruct();
    }

    public function setDefaultsOnConstruct()
    {
        
    }

    public function getRootElement()
    {
        return $this->_owner->getRootElement();
    }
}