<?php
namespace PhpDevil\Extensions\DataCollector\structure;

abstract class DCFormPrototype extends DCBlockPrototype
{
    protected $_providers = [];

    public function __construct($config, $owner = null, $name = null, $defaults = [])
    {
        parent::__construct($config, $owner, $name, $defaults);
        if (isset($config['providers'])) foreach ($config['providers'] as $kind=>$class) {
            $this->_providers[$kind] = $class;
        }
    }
}