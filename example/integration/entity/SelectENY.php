<?php
namespace PhpDevil\Extensions\DataCollector\example\integration\entity;
use PhpDevil\Extensions\DataCollector\example\integration\defaults\DCBootstrapEntity;

/**
 * Class SelectENY
 *
 * Выбор из трех значений:
 * - не выбрано (не проходит валидацию)
 * - нет - проходит
 * - да  - проходит
 *
 * @package PhpDevil\Extensions\DataCollector\example\integration\entity
 */
class SelectENY extends DCBootstrapEntity
{
    protected $_variants = ['null' => 'не выбрано', 'no' => 'нет', 'yes' => 'да',];

    public function isEmpty()
    {
        $value = $this->getValue(false);
        if ('null' == $value || empty($value)) {
            return true;
        } else {
            echo $value;
            return false;
        }
    }

    public function checked()
    {
        $value = $this->getValue(false);
        if ('yes' == $value) {
            return true;
        } else {
            return false;
        }
    }

    public function setDefaultsOnConstruct()
    {
        $this->_template = dirname(dirname(__DIR__)) .  '/views/defaults/entity.default.php';
    }
}