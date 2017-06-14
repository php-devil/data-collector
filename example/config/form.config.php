<?php
return [
    #-- Типы данных по умолчанию.
    #   - строка расценивается как имя класса
    #   - массив расценивается как описание прототипа
    'defaults' => [
        #-- основные типы атрибутов
        'entity'    => [
            #- поле
            'class'    => \PhpDevil\Extensions\DataCollector\example\integration\defaults\DCBootstrapEntity::class,
            'template' => dirname(__DIR__) . '/views/defaults/entity.default.php',
        ],
        'block'     => [
            #- блок
            'class'    => \PhpDevil\Extensions\DataCollector\structure\DCBlock::class,
            'template' => dirname(__DIR__) . '/views/defaults/block.default.php',
        ],
        'container' => [
            #- контейнер
            'class'    => \PhpDevil\Extensions\DataCollector\structure\DCContainer::class,
            'template' => dirname(__DIR__) . '/views/defaults/container.default.php',
        ],
    ],

    'prototype' => [
        'type' => 'block',
    ],

    #-- Атрибуты с фиксированными типами
    #   для атрибутов, не указанных в данном блоке атрибут будет создан из типа по умолчанию:
    #   - для контейнера - блок
    #   - для блока - поле
    #   - для поля попытка создать атрибут вызовет исключение
    'attributes' => [
        #-- пример блочного атрибута с указанием типа и шаблона. атрибуты блока будут созданы автоматически при
        #   первой отправке формы
        'person' => [
            'type' => 'block',
            'template' => dirname(__DIR__)  . '/views/blocks/person.block.php',
        ],

        #-- пример обычного блока с прототипом поля
        'proto' => [
            'type' => 'block',
            'prototype' => [
                'type' => 'entity',
                'variants'=>['none'=>'Никто', 'any'=>'Один', 'all'=>'Все'],
                'default' => 'any',
            ],
            'template' => dirname(__DIR__)  . '/views/blocks/proto.block.php',
        ],

        #-- составной блок (пронумерованные блоки с кнокой добавить)
        'multisimple' => [
            'type' => 'container',
            'prototype' => [
                'type'     => 'block',
                'template' => dirname(__DIR__)  . '/views/blocks/inner.block.php',
            ],
            'button'   => 'Добавить запись'
        ],

        #-- составной блок с вложениями составных блоков
        'multimultiple' => [
            'type' => 'container',
            'prototype' => [
                'type'     => 'block',
                'template' => dirname(__DIR__)  . '/views/blocks/inner2.block.php',
                'attributes' => [

                    #-- вложенный составной блок
                    'multiinner' => [
                        'type' => 'container',
                        'prototype' => [
                            'type' => 'block',
                            'template' => dirname(__DIR__)  . '/views/blocks/innerinner.block.php',
                        ],
                        'button'   => 'Добавить запись'
                    ],
                ],
            ],
            'button'   => 'Добавить запись'
        ],

        #-- блок, полями которого является флаг вида не выбрано-нет-да с комментариями если да
        'addons' => [
            'type' => 'block',
            'prototype' => [
                'class' => \PhpDevil\Extensions\DataCollector\example\integration\entity\BlockENYCommented::class,
                'attributes' => [
                    'flag' => [
                        'class' => \PhpDevil\Extensions\DataCollector\example\integration\entity\SelectENY::class,
                    ],
                    'comment' => ['type' => 'entity',]
                ]
            ],
        ],

        'nny' => [
            'class' => \PhpDevil\Extensions\DataCollector\example\integration\entity\SelectENY::class,
        ],

    ],

    #-- Представление блока для вывода методом render()
    'template' => dirname(__DIR__)  . '/views/form.view.php',

    #-- Провайдеры для чтения/сохранения данных
    'providers' => [
        'temporary' => new \PhpDevil\Extensions\DataCollector\providers\DCSessionProvider(['searchkey'=>'my-awesome-form']),
        'permanent' => null,
    ]
];