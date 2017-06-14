<?php
namespace PhpDevil\Extensions\DataCollector\structure;

/**
 * Class DCFormValidator
 *
 * Валидация форм
 *
 * @author Alexey Volkov <alex.phpdevil@gmail.com>
 */
abstract class DCFormValidator
{
    /**
     * Реакция на ошибку валидации поля
     *
     * @param $attribute
     * @param $message
     * @return mixed
     */
    abstract public function addValidationError($attribute, $message);

    /**
     * Реакция на успешное прохождение валидации полем
     *
     * @param $attribute
     * @return mixed
     */
    abstract public function onBeforeValidation($attribute);

    /**
     * Проверка заполненности полей
     *
     * @param array $attributes
     * @param string $message
     */
    public function validateRequired($attributes = [], $message = 'Field is required')
    {
        if (is_array($attributes) && !empty($attributes)) foreach($attributes as $obj) {
            if ($obj->isEmpty()) {
                $this->addValidationError($obj, $message);
            } else {
                $this->addValidationSuccess($obj);
            }
        }
    }

    /**
     * Валидация поля встроенным фильтром
     *
     * @param array $attributes
     * @param int $filter
     * @param string $message
     */
    protected function validateByFilter($attributes = [], $filter = FILTER_DEFAULT, $message = 'Field contains error')
    {
        if (is_array($attributes) && !empty($attributes)) foreach($attributes as $obj) {
            $value = $obj->getValue();
            if (filter_var($value, $filter)) {
                $this->addValidationSuccess($obj);
            } else {
                $this->addValidationError($obj, $message);
            }
        }
    }
}