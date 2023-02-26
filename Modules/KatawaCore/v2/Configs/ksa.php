<?php

use App\Modules\KatawaParser\v2\Modules\Dto\PositionDto;

return [
    /** Список всех персонажей, [ character_name => 'Описание' ] */
    'characters' => [
        'hi' => 'Хисао',
        'mystery' => '???',
        'iw' => 'Иванако',
        "Иванако" => 'Иванако',
        'father' => 'Отец',
        'doctor' => 'Доктор',
        'mu_' => 'Высокий мужчина',
        'mu' => 'Муто',
        'muto' => 'Муто',
        'mi_shi' => 'Сидзунэ',
        'mi_not_shi' => 'Сидзунэ + Миша',
        'mi' => 'Миша',
        'misha' => 'Миша',
        'shi' => 'Сидзунэ',
        'shizu' => 'Сидзунэ',
        'nk_' => 'Улыбчивый человек',
        'nk' => 'Фельдшер',
        'nurse' => 'Фельдшер',
        'ke_' => 'Сосед в очках',
        'ke' => 'Кендзи',
        'kenji' => 'Кендзи',
        'li_' => 'Светловолосая девушка',
        'li' => 'Лилли',
        'lilly' => 'Лилли',
        "lillyprop" => 'Лилли',
        'yu_' => 'Библиотекарь',
        'yu' => 'Юко',
        'yuukoshang' => 'Юко',
        "yuuko" => 'Юко',
        'ha_' => 'Девушка с чёлкой',
        'ha' => 'Ханако',
        'hanako' => 'Ханако',
        'emi_' => 'Девочка с хвостиками',
        'emi' => 'Эми',
        'rin_' => 'Странная девушка',
        'rin' => 'Рин',
        'emi_w_rin_' => 'Эми & Странная девушка',
        'emi_w_rin' => 'Эми & Рин',
        'no_' => 'Седой мужчина',
        'no' => 'Номия',
        'nomiya' => 'Номия',
        'aki_' => 'Хорошо одетый человек',
        'aki' => 'Акира',
        'akira' => 'Акира',
        'shiraki' => 'Сираки',
        'ke_hi' => 'Кендзи & Хисао',
        "hideaki" => 'Хидеаки',
        "hh" => 'Хидеаки',

        "shopkeep" => '',
        "hanagown" => '',
        "evfg" => '',
        "evbg" => '',
        "chessboard" => '',
        'wine' => '',
        "|Продавец" => '',
        "phone" => '',
        "|Девушка" => '',
        "|Миссис Сато" => '',
        "meiko" => 'Мейко',
        "emm" => 'Мейко',
        "emm_" => 'Загадочная женщина',
        "emicas" => '',
        "emiwheel" => '',
        "rinpan" => '',
        'sae' => 'Саэ',
        'sa' => 'Саэ',
        'shizuyu' => '',
        'mishashort' => '',
        'ssh' => 'Сидзунэ',
        'his' => 'Хисао',
        'jigoro' => 'Жигоро',
        'hx' => 'Жигоро',

        'sicchan' => 'Ситтян',
        'hicchan' => 'Хиттян',
        'hakamichi' => 'Хакамити',

        'aoi' => '',
        'mk' => ''
    ],

    /**
     * Если персонажи заданы видом 'hisao_smile_u' => '...' то нужно прописывать путь foreground/hisao_smile_u/...
     * Чтобы этого избежать можно ниже перечислить сокращения вида 'hisao_' => 'hisao'
     * Тогда hisao_smile_u превратиться в hisao и файл с изображением будет доступен по пути foreground/hisao/...
     * Проверяет на совпадение в начале строки
     */
    'replace_long_characters' => [],

    /** Путь к игре */
    'game_path' => public_path('games/ksa'),

    /**
     * Команды и обработчики для них
     */
    'commands' => [
        'default' => \App\Modules\KatawaParser\v2\Modules\Commands\DefaultCommand::class,
        'note' => \App\Modules\KatawaParser\v2\Modules\Commands\NoteCommand::class,
        'quote' => \App\Modules\KatawaParser\v2\Modules\Commands\QuoteCommand::class,
        'label' => \App\Modules\KatawaParser\v2\Modules\Commands\LabelCommand::class,
        'hide' => \App\Modules\KatawaParser\v2\Modules\Commands\HideCommand::class,
        'scene' => \App\Modules\KatawaParser\v2\Modules\Commands\SceneCommand::class,
        'with' => \App\Modules\KatawaParser\v2\Modules\Commands\WithCommand::class,
        'play' => \App\Modules\KatawaParser\v2\Modules\Commands\PlayCommand::class,
        'say' => \App\Modules\KatawaParser\v2\Modules\Commands\SayCommand::class,
        'stop' => \App\Modules\KatawaParser\v2\Modules\Commands\StopCommand::class,
        'emit' => \App\Modules\KatawaParser\v2\Modules\Commands\EmitCommand::class,
        'show' => \App\Modules\KatawaParser\v2\Modules\Commands\ShowCommand::class,

        'window' => \App\Modules\KatawaParser\v2\Modules\Commands\WindowCommand::class,
        'centered' => \App\Modules\KatawaParser\v2\Modules\Commands\CenteredCommand::class,
    ],

    /**
     * Пути для поиска моделей дефолтный
     * Если путь начинается с / то будет foreground/path, иначе foreground/character/path
     */
    'characters_lookup_path' => [
        'close',
        'superclose',
        'ksa',
        '/event/lilly_supercg'
    ],

    /** Пути для поиска персонажей из Event */
    'events_lookup_path' => [
        'ksa',
        'lilly_supercg',
        'hanako_kiss'
    ],

    /**
     * Для замены персонажей вида show phone
     *  В итоге будет img phone "vfx/mobile-sprite.png"
     *  параметр dissolve добавляет эффект появление длительностью 1 сек
     */
    'replace_characters_path' => [
        'lillyprop' => [
            'path' => 'vfx/prop_lilly_back_cane.png',
            'dissolve' => false
        ],
        'chessboard' => [
            'path' => 'vfx/chessboard.png',
            'dissolve' => true
        ],
        'mobile' => [
            'path' => 'vfx/mobile-sprite.png',
            'dissolve' => true
        ],
        'phone' => [
            'path' => 'vfx/mobile-sprite.png',
            'dissolve' => true
        ],
        'musicbox' => [
            'path' => 'vfx/musicbox_closed.png',
            'dissolve' => true
        ],
        'hanako_door_base' => [
            'path' => 'vfx/hanako_door_base.jpg',
            'dissolve' => true
        ],
        'hanako_door_door' => [
            'path' => 'vfx/hanako_door_door.jpg',
            'dissolve' => true
        ],
        'letter_insert' => [
            'path' => 'vfx/letter_insert.png',
            'dissolve' => true
        ],
        'wine' => [
            'path' => 'vfx/wine.png',
            'dissolve' => true
        ]
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
        'mk' => 'miki'
    ],

    /** Персонажи, которые общаются жестами */
    'sign_characters' => [
        'ssh',
        'his'
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
        '%(name_mizuki)s' => 'Мидзуки'
    ],

    /** Удаляет постфиксы с bg */
    'replace_bg_postfix' => [
        '_rn',
        '_fb'
    ],

    /** Музыка */
    'music_replace' => require __DIR__ . '/helpers/music.php',

    /** SFX звуки */
    'sfx_replace' => require __DIR__ . '/helpers/sfx.php',

    /** Виды позиций */
    'positions' => require __DIR__ . "/helpers/position.php"
];
