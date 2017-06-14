<?php
namespace PhpDevil\Extensions\DataCollector\example\integration\defaults;
use PhpDevil\Extensions\DataCollector\DCForm;
use PhpDevil\Extensions\DataCollector\structure\DCFormValidator;

/**
 * Class FormValidator
 *
 * Пример валидатора формы с проставлением статусов полей
 *
 * @author Alexey Volkov <alex.phpdevil@gmail.com>
 */
class FormValidator extends DCFormValidator
{
    protected $response = '';

    public function addValidationSuccess($attribute)
    {
        $attribute->setStatus('success');
        $this->response['status_global'][$attribute->getID()] = 'success';
    }

    public function addValidationError($attribute, $message)
    {
        $attribute->setStatus('error');
        $attribute->setMessage($message);

        $this->response['status_global'][$attribute->getID()] = 'error';
        $this->response['messages'][$attribute->getID()] = $attribute->getMessage('<br/>');
    }

    public function onBeforeValidation($attribute)
    {
        if ('none' === $attribute->getStatus()) {
            $attribute->setStatus('success');
            $this->response['status_global'][$attribute->getID()] = 'success';
        }
    }

    public function validate(DCForm $form)
    {
        $this->validateRequired([
            $form->person->surname,
            $form->nny,
        ], 'Поле обязательно для заполнения');
        $form->setResponse($this->response);
    }
}