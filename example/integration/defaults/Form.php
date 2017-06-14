<?php
namespace PhpDevil\Extensions\DataCollector\example\integration\defaults;
use PhpDevil\Extensions\DataCollector\DCForm;

/**
 * Class Form
 *
 * Пример сбора результатов валидации формы
 *
 * @author Alexey Volkov <alex.phpdevil@gmail.com>
 */
class Form extends DCForm
{
    protected $response = [];

    /**
     * Установка одного параметра ответа
     *
     * @param $section
     * @param $name
     * @param $value
     */
    public function setResponseValue($section, $name, $value)
    {
        $this->response[$section][$name] = $value;
    }

    /**
     * Установка ответа целиком
     *
     * @param array $response
     */
    public function setResponse($response = [])
    {
        $this->response = $response;
    }

    /**
     * Получение ответа
     * 
     * @return array
     */
    public function getResponse()
    {
        return $this->response;
    }
}