<?php
namespace PhpDevil\Extensions\DataCollector\structure;
use PhpDevil\Extensions\DataCollector\DCForm;
use PhpDevil\Extensions\DataCollector\interfaces\IDCBlock;

/**
 * Class DCAttributesFactory
 *
 * Фабрика атрибутов
 *
 * @package PhpDevil\Extensions\DataCollector\structure
 */
class DCAttributesFactory
{
    /**
     * Создание атрибута.
     *
     * Решение о типе атрибута принимается на основе конфигурации, создающего класса и
     * переданных типов данных по умолчанию
     *
     * @param array $config
     * @param $name
     * @param IDCBlock|null $owner
     *
     * @return mixed
     */
    public static function createAttribute($config = [], $name, IDCBlock $owner = null)
    {
        if (!isset($config['defaults'])) $config['defaults'] = $owner->getDefaults();

        if (isset($config['class'])) {
            return self::createFromClassName($config['class'], $config, $name, $owner);
        } elseif (isset($config['type'])) {
            return self::createFromTypeName($config['type'], $config, $name, $owner);
        } elseif ($proto = $owner->getPrototype()) {
            return self::createFromPrototype($proto, $config, $name, $owner);
        } else {
            // дефолтное создание, если не указано ничего
            if ($owner instanceof DCContainer) {
                return self::createFromTypeName('block', $config, $name, $owner);
            } elseif ($owner instanceof DCBlock || $owner instanceof DCForm) {
                return self::createFromTypeName('entity', $config, $name, $owner);
            } else {
                echo get_class($owner);
                throw new \Exception('Entity must not have attributes');
            }
        }

    }

    /**
     * Создание атрибута, если указан класс
     *
     * @param $class
     * @param $config
     * @param $name
     * @param $owner
     *
     * @throws \Exception
     * @return mixed
     */
    protected static function createFromClassName($class, $config, $name, $owner)
    {
        if (class_exists($class)) {
            return new $class($config, $owner, $name);
        } else {
            throw new \Exception('Error: class ' . $class . ' not found');
        }
    }

    /**
     * Создание атрибута, если указан тип
     *
     * @param $type
     * @param $config
     * @param $name
     * @param $owner
     *
     * @throws \Exception
     * @return mixed
     */
    protected static function createFromTypeName($type, $config, $name, $owner)
    {

        if (isset($config['defaults'][$type])) {
            if (is_array($config['defaults'][$type])) {
                return self::createFromPrototype($config['defaults'][$type], $config, $name, $owner);
            } else {
                return self::createFromClassName($config['defaults'][$type], $config, $name, $owner);
            }
        } else {
            throw new \Exception('Error: default type ' . $type . ' not found');
        }
    }

    /**
     * Создание атрибута, если указан прототип
     *
     * @param $prototype
     * @param $config
     * @param $name
     * @param $owner
     *
     * @return mixed
     */
    protected static function createFromPrototype($prototype, $config, $name, $owner)
    {
        $config = array_merge($prototype, $config);
        return self::createAttribute($config, $name, $owner);
    }
}