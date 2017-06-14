<?php
namespace PhpDevil\Extensions\DataCollector\example\integration\defaults;
use PhpDevil\Extensions\DataCollector\structure\DCEntity;

/**
 * Class DCBootstrapEntity
 *
 * Методы для отображения элементов управления формами
 *
 * @package PhpDevil\Extensions\DataCollector\example\integration\defaults
 */
class DCBootstrapEntity extends DCEntity
{
    protected $outerClass = 'col-xs-12';
    protected $text = '';
    protected $options = [];

    public function label($outerClass, $text, $options = [])
    {
        $this->outerClass = $outerClass;
        $this->text = $text;
        $this->options = $options;
        return $this->getInputControl('label');
    }

    public function select($outerClass, $options = [], $default = null)
    {
        $this->outerClass = $outerClass;
        $this->options = $options;
        if (null !== $default) {
            $this->setDefaultValue($default);
        }
        return $this->getInputControl('select');
    }

    public function checkbox($outerClass, $placeholder = '', $options = [], $checked = null)
    {
        $this->outerClass = $outerClass;
        $this->options = $options;
        $this->text = $placeholder;
        $this->_variants = [0=>0, 1=>1];
        if (null !== $checked) {
            $this->setDefaultValue($checked ? 1 : 0);
        }
        return $this->getInputControl('checkbox');
    }

    public function checked()
    {
        return (bool) $this->getValue();
    }

    public function input($outerClass, $placeholder = '', $options = [])
    {
        $this->outerClass = $outerClass;
        $this->options = $options;
        $this->text = $placeholder;
        return $this->getInputControl('text');
    }

    public function text($outerClass, $placeholder = '', $options = [])
    {
        $this->outerClass = $outerClass;
        $this->options = $options;
        $this->text = $placeholder;
        return $this->getInputControl('textarea');
    }
}