<?php
namespace PhpDevil\Extensions\DataCollector\structure;
use PhpDevil\Extensions\DataCollector\DCForm;

abstract class DCBlockPrototype extends DCEntityPrototype
{
    /**
     * Атрибуты блока
     * @var array
     */
    protected $_attributes = [];

    /**
     * Прототип для новых атрибутов
     * @var array
     */
    protected $_prototype = [];

    protected $_defaults = [];

    public function __get($name)
    {
        if (!isset($this->_attributes[$name])) {
            $this->_attributes[$name] = DCAttributesFactory::createAttribute([], $name, $this);
        }
        return $this->_attributes[$name];
    }

    public function export($valueOnVariant = false)
    {
        $arr = [];
        if (is_array($this->_attributes)) foreach($this->_attributes as $k=>$v) {
            $arr[$k] = $v->export($valueOnVariant);
        }
        return $arr;
    }

    /**
     * Параметры типов по умолчанию
     * @return array
     */
    public function getDefaults()
    {
        if (null === $this->_defaults && is_object($this->_owner)) {
            return $this->_owner->getDefaults();
        } else {
            return $this->_defaults;
        }
    }

    /**
     * Получение прототипа атрибута для блоков с однотипными записями
     * @return array|null
     */
    public function getPrototype()
    {
        if (!empty($this->_prototype)) {
            return $this->_prototype;
        } else {
            return null;
        }
    }

    /**
     * Рендер шаблона блока
     *
     * @param bool $display
     * @return string
     * @throws \Exception
     */
    public function render($display = DCForm::MODE_RETURN)
    {
        if (isset($this->_template) && file_exists($this->_template)) {
            ob_start();
            include $this->_template;
            if (DCForm::MODE_DISPLAY === $display) {
                echo ob_get_clean();
            } else {
                return ob_get_clean();
            }
        } else {
            throw new \Exception('Error: block template not found in ' . get_class($this));
        }
    }

    protected function discoverAttributes($attributes)
    {
        foreach($attributes as $name=>$config) {
            $this->_attributes[$name] = DCAttributesFactory::createAttribute($config, $name, $this);
        }
    }

    public function applyAttributes($data, $saveMode = DCForm::SAVE_NONE)
    {
        if (is_array($data)) foreach($data as $name=>$value) {
            if (!isset($this->_attributes[$name])) {
                $this->_attributes[$name] = DCAttributesFactory::createAttribute([], $name, $this);
            }
            $this->_attributes[$name] -> applyAttributes($value, $saveMode);
        }
    }

    public function validate($validator)
    {
        if (!empty($this->_attributes)) foreach($this->_attributes as $obj) {
            $obj->validate($validator);
        }
    }

    public function __construct($config, $owner = null, $name = null, $defaults = [])
    {
        $this->_owner = $owner;
        $this->_name = $name;

        if (isset($config['template'])) {
            $this->_template = $config['template'];
        }
        if (isset($config['defaults'])) {
            $defaults = array_merge($defaults, $config['defaults']);
            if (is_object($owner) && $defaults === $owner->getDefaults()) {
                $this->_defaults = null;
            } else {
                if (!is_array($this->_defaults)) $this->_defaults = [];
                $this->_defaults = array_merge($this->_defaults, $defaults);
            }
        }
        if (isset($config['prototype'])) {
            $this->_prototype = $config['prototype'];
        }

        if (!empty($config['attributes'])) {
            $this->discoverAttributes($config['attributes']);
        }
        $this->setDefaultsOnConstruct();
    }
}