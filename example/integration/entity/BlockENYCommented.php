<?php
namespace PhpDevil\Extensions\DataCollector\example\integration\entity;
use PhpDevil\Extensions\DataCollector\structure\DCBlock;

class BlockENYCommented extends DCBlock
{
    protected $flagLabel   = 'Выберите';
    protected $textComment = 'Комментарий';

    public function custom($l, $c)
    {
        $this->flagLabel = $l;
        $this->textComment = $c;
        return $this->render();
    }

    public function setDefaultsOnConstruct()
    {
        $this->_template = dirname(dirname(__DIR__)) . '/views/defaults/block.commented.php';
    }
}