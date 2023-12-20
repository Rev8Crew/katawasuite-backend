<?php

return [
    /** Список всех персонажей, [ character_name => 'Описание' ] */
    'characters' => array_merge( require __DIR__.'/ks/characters.php', require __DIR__.'/letter_to_venus/characters.php'),

    /**
     * Если персонажи заданы видом 'hisao_smile_u' => '...' то нужно прописывать путь foreground/hisao_smile_u/...
     * Чтобы этого избежать можно ниже перечислить сокращения вида 'hisao_' => 'hisao'
     * Тогда hisao_smile_u превратиться в hisao и файл с изображением будет доступен по пути foreground/hisao/...
     * Проверяет на совпадение в начале строки
     */
    'replace_long_characters' => [],

    /** Путь к игре */
    'game_path' => public_path('games/letter_to_venus'),

    /**
     * Команды и обработчики для них
     */
    'commands' => require __DIR__.'/helpers/commands.php',

    /**
     * Пути для поиска моделей дефолтный
     * Если путь начинается с / то будет foreground/path, иначе foreground/character/path
     */
    'characters_lookup_path' => [
        'close',
        'superclose',
        '/event/lilly_supercg',
    ],

    /** Пути для поиска персонажей из Event */
    'events_lookup_path' => [
        'ksa',
        'lilly_supercg',
        'hanako_kiss',
        'letter_to_venus'
    ],

    /**
     * Для замены персонажей вида show phone
     *  В итоге будет img phone "vfx/mobile-sprite.png"
     *  параметр dissolve добавляет эффект появление длительностью 1 сек
     */
    'replace_characters_path' => [
        'lillyprop' => [
            'path' => 'vfx/prop_lilly_back_cane.png',
            'dissolve' => false,
        ],
        'chessboard' => [
            'path' => 'vfx/chessboard.png',
            'dissolve' => true,
        ],
        'mobile' => [
            'path' => 'vfx/mobile-sprite.png',
            'dissolve' => true,
        ],
        'phone' => [
            'path' => 'vfx/mobile-sprite.png',
            'dissolve' => true,
        ],
        'musicbox' => [
            'path' => 'vfx/musicbox_closed.png',
            'dissolve' => true,
        ],
        'hanako_door_base' => [
            'path' => 'vfx/hanako_door_base.jpg',
            'dissolve' => true,
        ],
        'hanako_door_door' => [
            'path' => 'vfx/hanako_door_door.jpg',
            'dissolve' => true,
        ],
        'letter_insert' => [
            'path' => 'vfx/letter_insert.png',
            'dissolve' => true,
        ],
        'wine' => [
            'path' => 'vfx/wine.png',
            'dissolve' => true,
        ],
        'venus_book' => [
            'path' => 'vfx/venus_book.png',
            'dissolve' => true,
        ],
    ],

    /** Замена персонажей */
    'replace_characters' => [
        'evbg' => 'lilly',
        'evfg' => 'lilly',
        //'yuuko' => 'yu',
        'emm' => 'meiko',
        'emm_' => 'meiko_',
        'Иванако' => 'iw',
        '|Девушка' => 'girl',
        '|Продавец' => 'seller',
        '|Миссис Сато' => 'missis_sato',
        'mk' => 'miki',
    ],

    /** Персонажи, которые общаются жестами */
    'sign_characters' => [
        'ssh',
        'his',
    ],

    /**
     *  Исправляет следующие строки: заменяя %(name_sicchan)s на нужный из characters[]
     *  mi "%(name_sicchan)s говорит, что теперь ты прощён, %(name_hicchan)s."
     */
    'replace_characters_from_message' => [
        '%(name_kenji)s' => 'Кендзи',
        '%(name_shizune)s' => 'Сидзуне',
        '%(name_hakamichi)s' => 'Хакамити',
        '%(name_sicchan)s' => 'Ситтян',
        '%(name_hicchan)s' => 'Хиттян',
        '%(name_mizuki)s' => 'Мидзуки',
        '%(name_hideaki)s' => 'Хидеаки',
        '%(name_jigoro)s' => 'Жигоро',
        '%(name_yamato_nadeshiko)s' => 'ямато-надэсико',
        '%(name_shiina)s' => 'Сиина',
    ],

    /** Удаляет постфиксы с bg */
    'replace_bg_postfix' => [
        '_rn',
        '_fb',
    ],

    /** Музыка */
    'music_replace' => require __DIR__.'/helpers/music.php',

    /** SFX звуки */
    'sfx_replace' => require __DIR__.'/helpers/sfx.php',

    /** Виды позиций */
    'positions' => require __DIR__.'/helpers/position.php',
];
