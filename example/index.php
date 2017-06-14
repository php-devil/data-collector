<?php
require_once dirname(__DIR__) . '/vendor/autoload.php';
use PhpDevil\Extensions\DataCollector\example\integration\defaults\Form;

/**
 * Загрузка конфигурации формы
 */
$formConfig = require_once  __DIR__ . '/config/form.config.php';

/**
 * Создание, отображение формы,
 * получение переданных пользователем данных
 */
try {
    $form = new Form($formConfig);
    // если не пустой $_POST заставляем форму обработать его:
    if (!empty($_POST)) {

        //echo $_POST['action'];

        if(isset($_POST['action'])) {
            echo $form->autoDetectData($_POST); // обработка действий, предусмотренных классом формы
        } else {
            // сабмит формы
            print_r($_POST);
            $form->applyAttributes($_POST); // по умолчанию сохраняем только во временное хранилище (сессию)
            print_r($form->export(true));
        }
        exit(0);                            // и вырубаем дальнейшее выполнение скрипта
    } else {
        // дайствия, если не было POST запроса
    }

    $validator = new \PhpDevil\Extensions\DataCollector\example\integration\defaults\FormValidator();
    $validator->validate($form);

    if (!empty($_POST)) {
        echo $form->getResponse();
    }

    $form->render(Form::MODE_DISPLAY);
} catch (Exception $e) {
    /**
     * Обработка ошибки этапа создания формы
     */

    echo $e->getMessage();

    echo '<pre>';
    print_r($e->getTrace());
    echo '</pre>';

    exit($e->getCode());
}



