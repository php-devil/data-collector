<?php
/**
 * Created by PhpStorm.
 * User: AAVolkov
 * Date: 11.11.2016
 * Time: 11:15
 */

namespace PhpDevil\Extensions\DataCollector\interfaces;


use PhpDevil\Extensions\DataCollector\DCForm;

interface IDataProvider
{
    public function load(DCForm $form);

    public function save(DCForm $form);
}