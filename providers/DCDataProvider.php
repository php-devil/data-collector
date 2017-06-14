<?php
namespace PhpDevil\Extensions\DataCollector\providers;
use PhpDevil\Extensions\DataCollector\interfaces\IDataProvider;

abstract class DCDataProvider implements IDataProvider
{
    protected $config = [];

    protected function initDefaults()
    {
        // для определения настроек в дочерних классах
        // по умолчанию ничего не делаем
    }

    public function __construct($config = [])
    {
        $this->config = $config;
        $this->initDefaults();
    }
}