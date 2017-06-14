<?php
namespace PhpDevil\Extensions\DataCollector\structure;

class DCEntity extends DCEntityPrototype
{
    protected $htmlType = 'text';
    protected $_html = [];
    protected $_htmlDefaults = [];

    protected $options = [];

    public function __toString()
    {
        return (string) $this->getValue();
    }

    final protected function getInputControl($type)
    {
        $this->reset();
        $this->htmlType = $type;
        if (!empty($this->options)) {
            $delimiter = '';
            $htmlTemp = '';
            foreach($this->options as $k=>$v) {
               // if (0 === strpos($k, 'data-')) {
                    $htmlTemp .= $delimiter . $k . '="' . $v . '"';
                    $delimiter = ' ';
               // }
            }
            $this->options = $htmlTemp;
        } else {
            $this->options = '';
        }
        return $this->render();
    }

    public function validate($validator)
    {
        
    }

    protected function reset()
    {
        $this->htmlType = 'text';
        $this->_html = $this->_htmlDefaults;
    }

    protected function render()
    {
        ob_start();
        include $this->_template;
        return ob_get_clean();
    }
}