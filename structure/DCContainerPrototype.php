<?php
namespace PhpDevil\Extensions\DataCollector\structure;
use PhpDevil\Extensions\DataCollector\DCForm;

abstract class DCContainerPrototype extends DCBlockPrototype
{
    protected $_button = 'Add a record';

    public function createAttribute($name = null)
    {
        return DCAttributesFactory::createAttribute([], $name, $this);
    }

    public function applyAttributes($data, $saveMode = DCForm::SAVE_NONE)
    {
        if (is_array($data) && !empty($data)) {
            $this->_attributes = [];
            $data = array_values($data);
            foreach($data as $name=>$value) {
                $this->_attributes[$name] = $this->createAttribute($name);
                $this->_attributes[$name]->applyAttributes($value, $saveMode);
            }
        }
    }

    public function export($valueOnVariant = false)
    {
        $arr = [];
        if (is_array($this->_attributes)) foreach($this->_attributes as $v) {
            $arr[] = $v->export($valueOnVariant);
        }
        return $arr;
    }

    public function __construct($config, $owner = null, $name = null, $defaults = [])
    {
        parent::__construct($config, $owner, $name, $defaults);
        $this->getRootElement()->registerAccessIdentifier($this->getID(), $this);
        if (isset($config['button'])) {
            $this->_button = $config['button'];
        }
    }
}