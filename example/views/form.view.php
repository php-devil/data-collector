<!DOCTYPE HTML>
<html>
    <head>
        <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-2.2.4.min.js"
                integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
                crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="/assets/datacollector.extension.js"></script>
        <style>
            .entity-container .error-message {display: none; color: #900;}
            .entity-container.has-error .error-message {display: block;}
        </style>
    </head>
    <body>
        <header>
            <div class="container">
                <h1>#DataCollector</h1>
            </div>
            <hr/>
        </header>

        <div class="container">
            <form action="" method="post" data-role="DataCollectorForm">
            <h1 class="col-xs-12">Форма</h1>
            <h2 class="col-xs-12">Блок из типа (person)</h2>
            <?=$this->person->render()?>

            <h2 class="col-xs-12">Блок с прототипом сущности</h2>
            <?=$this->proto->render()?>

            <h2 class="col-xs-12">Простой мультиблок</h2>
            <?=$this->multisimple->render()?>

            <h2 class="col-xs-12">Составной мультиблок</h2>
            <?=$this->multimultiple->render()?>

            <h2 class="col-xs-12">Условно-отображаемые параметры</h2>

            <div class="row form-group">
               <?=$this->params->show1->checkbox('col-xs-12', 'Показать подблок 1', ['data-role'=>'toggle-block', 'data-toggle'=>'show1_addon'], true)?>
            </div>
            <div data-role="toggleable" data-block="show1_addon" <?php if(!$this->params->show1->checked())echo'class="hidden"'?>>
                <div class="row form-group">
                    <h3 class="col-xs-12">toggleable block when checked</h3>
                </div>
            </div>

            <div class="row form-group">
                <?=$this->params->show2->checkbox('col-xs-12', 'Скрыть подблок 2', ['data-role'=>'toggle-block', 'data-toggle'=>'show2_addon'], true)?>
            </div>
            <div data-role="toggleable" data-block="show2_addon" <?php if($this->params->show2->checked())echo'class="hidden"'?>>
                <div class="row form-group">
                    <h3 class="col-xs-12">toggleable block when NOT checked</h3>
                </div>
            </div>

            <div class="row form-group">
                <?=$this->params->show3->checkbox('col-xs-12', 'Переключить подблок 3', ['data-role'=>'toggle-block', 'data-toggle'=>'show3_addon'], false)?>
            </div>

                <div data-role="toggleable" data-block="show3_addon" <?php if($this->params->show3->checked())echo'class="hidden"'?>>
                    <div class="row form-group">
                        <h3 class="col-xs-12">toggleable block when NOT checked</h3>
                    </div>
                </div>

                <div data-role="toggleable" data-block="show3_addon" <?php if(!$this->params->show3->checked())echo'class="hidden"'?>>
                    <div class="row form-group">
                        <h3 class="col-xs-12">toggleable block when checked</h3>
                    </div>
                </div>

            <h2 class="col-xs-12">Селект с пунктом "не выбрано"</h2>
            <div class="row form-group">
                <?=$this->nny->select('col-xs-12')?>
            </div>

            <h2 class="col-xs-12">Блок выбора с флагом и комментарием</h2>
            <?=$this->addons->fieldOne->custom('Флаг 1', 'Подпись коммента 1');?>
            <?=$this->addons->fieldTwo->custom('Флаг 2', 'Подпись коммента 2');?>


            <div class="row form-group">
                <div class="col-xs-10">
                    <a href="#modalDropData" class="btn btn-danger btn-lg" data-toggle="modal">Стереть данные</a>
                </div>
                <div class="col-xs-2">
                    <button class="btn btn-primary btn-lg" type="submit">Отправить</button>
                </div>
            </div>
            </form>
        </div>


        <div id="modalDropData" class="modal fade danger">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Заголовок модального окна -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Подтвердите удаление данных</h4>
                    </div>
                    <!-- Основное содержимое модального окна -->
                    <div class="modal-body">
                        Будут удалены все введенные данные на всех этапах заполнения данной формы.
                        Удаление введенных данных необратимо.
                    </div>
                    <!-- Футер модального окна -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Не стирать</button>
                        <button type="button" class="btn btn-danger" data-action="drop-data">Стереть данные</button>
                    </div>
                </div>
            </div>
        </div>


        <footer>
        <hr/>
        <div class="container">
            <h1>Результаты обработки</h1>
            <h2>Запрос:</h2>
            <pre id="request">форма не отправлялась</pre>
            <h2>Response:</h2>
            <pre id="response">форма не отправлялась</pre>
            <h2>Массив данных:</h2>
            <pre><?php print_r($this->export()); ?></pre>
            <h2>Класс формы:</h2>
            <pre><?php print_r($this); ?></pre>
        </div>

        </footer>
    </body>
</html>