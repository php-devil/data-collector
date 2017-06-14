/**
 * Пример фронтенд скрипта для основных событий формы и отрисовки
 * отдельных динамических элементов
 */

var DCDataCollectorDebug = false;

if ('undefined' == typeof(jQuery)) {
    console.error('DataCollector javascript requires jQuery');
} else {
    // постоянные действия
    $(document).ready(function(){
        updateLiveElements();

        $('html, body').animate({scrollTop: 0},500);

        /**
         * Добавление подблока
         */
        $(document).on('click', '[data-role="addblock-button"] [data-role="button"]', function(){
            var container = $(this).attr('data-block');
            var entity = $(this).attr('data-entity');
            var elements = $('[data-container="' + container + '"]>[data-role="block-container-entity"]').length;
            $.ajax({
                url: '',
                type: 'POST',
                data: {'action': 'loadblock', 'id': container, 'name': elements},
                success: function (data) {
                    if (DCDataCollectorDebug) {
                        alert(data);
                    }
                    $(data).insertBefore('[data-container="' + container + '"]>[data-role="addblock-button"]');
                }
            });
            return false;
        });

        /**
         * Сброс временного хранилища данных формы
         */
        $(document).on('click', '[data-action="drop-data"]', function(){
            $.ajax({
                url: '',
                type: 'POST',
                data: {'action': 'dropAll'},
                success: function (data) {
                    if (DCDataCollectorDebug) {
                        alert(data);
                    }
                    location.reload();
                }
            });
            return false;
        });

        /**
         * Переключение видимости блока
         */
        $(document).on('change', '[data-role="toggle-block"]', function(){
            var toggleable = $(this).attr('data-toggle');
            $('[data-block="' + toggleable + '"]').toggleClass('hidden');
        });

        /**
         * Обновление данных при сабмите формы
         */
        $(document).on('submit', 'form[data-role="DataCollectorForm"]', function(){
            console.log('submitting...');
            var formData = $(this).serialize();
            $('#request').html(formData);
            $('#response').html('отправка...');
            $.ajax({
                url: '',
                type: 'POST',
               // dataType: 'JSON',
                data: formData,
                success: function (data) {
                    console.log('success');
                    $('#response').html(data);
                },
                done: function(data) {
                    //$('#response').html(data);
                },
                fail: function(data) {
                    $('#response').html('ошибка запроса...');
                }
            });
            return false;
        });

        /**
         * Для полей вида флаг с комментарием
         */
        $(document).on('change', '[data-role="toggle-comment"]', function(){
            var toggleable = $(this).attr('data-toggle');
            var value = $(this).val();
            if ('yes' == value) {
                $('[data-block="' + toggleable + '"]').removeClass('hidden');
            } else {
                $('[data-block="' + toggleable + '"]').addClass('hidden');
            }
        });
    });
}

/**
 * Статичные модификации элементов страницы на основе (переопределяются при подгрузке элемнтов)
 * data-role, data-action и т.п.
 */
function updateLiveElements()
{
    console.log('updating elements masks');
}
