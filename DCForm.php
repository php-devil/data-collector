<?php
namespace PhpDevil\Extensions\DataCollector;
use PhpDevil\Extensions\DataCollector\interfaces\IDCBlock;
use PhpDevil\Extensions\DataCollector\structure\DCFormPrototype;

/**
 * Class DCForm
 *
 * Автособираемая форма
 *
 * @package PhpDevil\Extensions\DataCollector
 */
class DCForm extends DCFormPrototype implements IDCBlock
{
    const MODE_DISPLAY = true;
    const MODE_RETURN  = false;

    const SAVE_NONE = 0;
    const SAVE_TEMPORARY = 1;
    const SAVE_PERMANENT = 2;

    /**
     * Блоки для быстрого доступа:
     * - контейнеры (для поиска по id при нажатии кнопки добавить)
     *
     * @var array
     */
    protected $fastAccessElements = [];

    /**
     * Регистрация блока для быстрого доступа
     *
     * @param $identifier
     * @param $object
     */
    public function registerAccessIdentifier($identifier, $object)
    {
        $this->fastAccessElements[$identifier] = $object;
    }

    /**
     * Доступ к ранее зарегистрированному блоку
     *
     * @param $identifier
     * @return mixed|null
     */
    public function getElementByID($identifier)
    {
        if (isset($this->fastAccessElements[$identifier])) {
            return $this->fastAccessElements[$identifier];
        } else {
            return null;
        }
    }

    /**
     * Применение атрибутов
     *
     * @param $data
     * @param int $saveMode
     */
    public function applyAttributes($data, $saveMode = DCForm::SAVE_TEMPORARY)
    {
        parent::applyAttributes($data);
        switch($saveMode) {
            case DCForm::SAVE_NONE:
                // не сохраняем, если это явно указано
                break;
            case DCForm::SAVE_PERMANENT:
                // постоянное сохранение

                // break опущен намеренно - временное сохранение должно срабатывать всегда, если параметром
                // явно не передано, что сохранять данные не нужно (DCForm::SAVE_NONE)
            case DCForm::SAVE_TEMPORARY:
                // временное сохранение
                if (isset($this->_providers['temporary'])) {
                    $this->_providers['temporary']->save($this);
                }

        }
    }

    /**
     * Доступ к форме (корневому блоку) из любого подблока или сущности
     * @return $this
     */
    public function getRootElement()
    {
        return $this;
    }

    public function ajaxDropAll()
    {
        if (isset($this->_providers['temporary'])) {
            $this->_providers['temporary']->drop();
        }
    }

    public function ajaxLoadblock($id, $name)
    {
        if (!$element = $this->getElementByID($id)) {
            if ($element=$this->longSearchByID($id)) {
                $this->fastAccessElements[$id] = $element;
            }
        }
        if ($element) {
            return $element->createAttribute($name)->render();
        } else {
            return false;
        }
    }

    /**
     * Длинный поиск по ID если идентификатора нет в списке быстрого доступа
     *
     * @param $identifier
     * @return mixed
     */
    public function longSearchByID($identifier)
    {
        $path = explode('_', $identifier);
        if (is_array($path)) {
            $element = $this;
            foreach($path as $e) {
                if (null !== $element->$e) {
                    $element = $element->$e;
                } else {
                    $element = null;
                    break;
                }
            }
        } else {
            $element = null;
        }

        return $element;
    }

    /**
     * @param array $from
     * @return mixed|null
     */
    public function autoDetectData($from = [])
    {
        if (isset($from['action'])) {
            $action = 'ajax' . ucfirst($from['action']);
            unset($from['action']);
            if (method_exists($this, $action)) {
                return call_user_func_array([$this, $action], $from);
            }
        } else {
            return null;
        }
    }

    public function __construct($config, $owner = null, $name = null, $defaults = [])
    {
        parent::__construct($config, $owner, $name, $defaults);
        if (isset($this->_providers['temporary'])) {
            $this->_providers['temporary']->load($this);
        }
    }
}