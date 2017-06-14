<?php
namespace PhpDevil\Extensions\DataCollector\providers;
use PhpDevil\Extensions\DataCollector\DCForm;
use PhpDevil\Extensions\DataCollector\interfaces\IDataProvider;

/**
 * Class DCSessionProvider
 *
 * Провайдер данных формы для хранения в сессии
 *
 * @package PhpDevil\Extensions\DataCollector\providers
 */
class DCSessionProvider extends DCDataProvider implements IDataProvider
{
    /**
     * Ключ в сессии для чтения/сохранения данных
     *
     * @var string
     */
    protected $searchKey = 'phpdevil-data-collector';

    /**
     * Сохранение данных формы в сессии
     *
     * @param DCForm $form
     */
    public function save(DCForm $form)
    {
        $_SESSION[$this->searchKey] = $form->export(false);
    }

    public function drop()
    {
        unset($_SESSION[$this->searchKey]);
    }

    /**
     * Чтение данных формы из сессии
     *
     * @param DCForm $form
     */
    public function load(DCForm $form)
    {
        if (isset($_SESSION[$this->searchKey])) {
            $form->applyAttributes($_SESSION[$this->searchKey]);
        }
    }

    /**
     * Инициализация
     */
    protected function initDefaults()
    {
        session_start();
        if (isset($this->config['searchkey'])) {
            $this->searchKey = $this->config['searchkey'];
        }
    }
}