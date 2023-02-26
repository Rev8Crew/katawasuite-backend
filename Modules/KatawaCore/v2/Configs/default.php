<?php

use Modules\KatawaCore\v2\Modules\Dto\PositionDto;

return [
    /** Список всех персонажей, [ character_name => 'Описание' ] */
    'characters' => [],

    /**
     * Если персонажи заданы видом 'hisao_smile_u' => '...' то нужно прописывать путь foreground/hisao_smile_u/...
     * Чтобы этого избежать можно ниже перечислить сокращения вида 'hisao_' => 'hisao'
     * Тогда hisao_smile_u превратиться в hisao и файл с изображением будет доступен по пути foreground/hisao/...
     * Проверяет на совпадение в начале строки
     */
    'replace_long_characters' => [],

    /** Путь к игре */
    'game_path' => public_path('games/sc'),

    /**
     * Команды и обработчики для них
     */
    'commands' => [
        'default' => \Modules\KatawaCore\v2\Modules\Commands\DefaultCommand::class,
        'note' => \Modules\KatawaCore\v2\Modules\Commands\NoteCommand::class,
        'quote' => \Modules\KatawaCore\v2\Modules\Commands\QuoteCommand::class,
        'label' => \Modules\KatawaCore\v2\Modules\Commands\LabelCommand::class,
        'hide' => \Modules\KatawaCore\v2\Modules\Commands\HideCommand::class,
        'scene' => \Modules\KatawaCore\v2\Modules\Commands\SceneCommand::class,
        'with' => \Modules\KatawaCore\v2\Modules\Commands\WithCommand::class,
        'play' => \Modules\KatawaCore\v2\Modules\Commands\PlayCommand::class,
        'say' => \Modules\KatawaCore\v2\Modules\Commands\SayCommand::class,
        'stop' => \Modules\KatawaCore\v2\Modules\Commands\StopCommand::class,
        'emit' => \Modules\KatawaCore\v2\Modules\Commands\EmitCommand::class,
        'show' => \Modules\KatawaCore\v2\Modules\Commands\ShowCommand::class,

        'window' => \Modules\KatawaCore\v2\Modules\Commands\WindowCommand::class,
    ],

    /** Пути для поиска моделей дефолтный */
    'characters_lookup_path' => [
        'close',
        'superclose',
    ],

    /** Пути для поиска персонажей из Event */
    'events_lookup_path' => [
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
    ],

    /** Замена персонажей */
    'replace_characters' => [
        'evbg' => 'lilly',
        'evfg' => 'lilly',
        'yuuko' => 'yu',
        'emm' => 'meiko',
        'emm_' => 'meiko_',
        'Иванако' => 'iw',
        '|Девушка' => 'girl',
        '|Продавец' => 'seller',
        '|Миссис Сато' => 'missis_sato',
    ],

    /** Персонажи которые общаются жестами */
    'sign_characters' => [
        'ssh',
        'his'
    ],

    /** Удаляет постфиксы с bg */
    'replace_bg_postfix' => [

    ],

    /** Музыка */
    'music_replace' => [
        'music_tranquil' => 'Afternoon.ogg',
        'music_nurse' => 'Ah_Eh_I_Oh_You.ogg',
        'music_soothing' => 'Air_Guitar.ogg',
        'music_twinkle' => 'Aria_de_lEtoile.ogg',
        'music_moonlight' => 'Breathlessly.ogg',
        'music_rain' => 'Caged_Heart.ogg',
        'music_tragic' => 'Cold_Iron.ogg',
        'music_comfort' => 'Comfort.ogg',
        'music_lilly' => 'Concord.ogg',
        'music_daily' => 'Daylight.ogg',
        'music_ease' => 'Ease.ogg',
        'music_another' => 'Everyday_Fantasy.ogg',
        'music_friendship' => 'Friendship.ogg',
        'music_happiness' => 'Fripperies.ogg',
        'music_comedy' => 'Generic_Happy_Music.ogg',
        'music_tension' => 'High_Tension.ogg',
        'music_running' => 'Hokabi.ogg',
        'music_innocence' => 'Innocence.ogg',
        'music_heart' => 'Letting_my_Heart_Speak.ogg',
        'music_serene' => 'Lullaby_of_Open_Eyes.ogg',
        'music_drama' => 'Moment_of_Decision.ogg',
        'music_night' => 'Nocturne.ogg',
        'music_kenji' => 'Out_of_the_Loop.ogg',
        'music_hanako' => 'Painful_History.ogg',
        'music_rin' => 'Parity.ogg',
        'music_timeskip' => 'Passing_of_Time.ogg',
        'music_dreamy' => 'Raindrops_and_Puddles.ogg',
        'music_jazz' => 'Red_Velvet.ogg',
        'music_romance' => 'Romance_in_Andante_II.ogg',
        'music_credits' => 'Romance_in_Andante.ogg',
        'music_musicbox' => 'Sarabande_from_BWV1010,_Musicbox.ogg',
        'music_normal' => 'School_Days.ogg',
        'music_sadness' => 'Shadow_of_the_Truth.ogg',
        'music_emi' => 'Standing_Tall.ogg',
        'music_pearly' => 'Stride.ogg',
        'music_shizune' => 'The_Student_Council.ogg',
        'music_one' => 'To_Become_One.ogg',
        'music_menus' => 'Wiosna.ogg',

        'music_chance' => 'Giving_Life_a_Chance.ogg',
        'music_rika' => 'Always_Strong.ogg',
        'music_saki' => 'Blossoming_Happiness_Theory.ogg',
        'music_teamV' => 'V_Means_Agony.ogg',
        'music_class24' => 'Vivisection.ogg',
        'music_box' => 'Whats_in_the_Box.ogg',
        'music_act_intro' => 'Life_Expectancy.ogg',
    ],

    /** SFX звуки */
    'sfx_replace' => [
        "sfx_can_clatter" => "can_clatter",
        "sfx_park" => "parkambience",
        "sfx_crowd_indoors" => "crowd_indoors",
        "sfx_normalbell" => "carillon",
        "sfx_crowd_outdoors" => "crowd_outdoors",
        "sfx_storebell" => "storebell",
        "sfx_blop" => "blop",
        "sfx_fireworks" => "fireworks",
        "sfx_running" => "running",
        "sfx_birdstakeoff" => "birdstakeoff",
        "sfx_traffic" => "traffic",
        "sfx_pillow" => "pillow",
        "sfx_broken_plate" => "broken_plate",
        "sfx_sitting" => "sitting",
        "sfx_dooropen" => "dooropen",
        "sfx_impact" => "wumph",
        "sfx_splash" => "splash",
        "sfx_void" => "void.mp3",
        "sfx_doorclose" => "doorclose",
        "sfx_rain" => "rain",
        "sfx_doorknock_soft" => "doorknock2",
        "sfx_doorknock" => "doorknock",
        "sfx_shower" => "shower",
        "sfx_alarmclock" => "alarm",
        "sfx_switch" => "switch",
        "sfx_hammer" => "hammer",
        "sfx_rustling" => "rustling",
        "sfx_whiteout" => "whiteout",
        "sfx_car_driving" => "car_driving",
        "sfx_cycling" => "cycling",
        "sfx_can" => "can",
        "sfx_tray_rattling" => "tray_rattling",
        "sfx_bat_hit" => "bat_hit",
        "sfx_kick_machine" => "kick_machine",
        "sfx_snap" => "snap",
        "sfx_doorslam" => "doorslam",
        "sfx_tcard" => "tcard",
        "sfx_rumble" => "rumble",
        "sfx_cicadas" => "cicadas",
        "sfx_cellphone" => "cellphone",
        "sfx_cutlery" => "cutlery",
        "sfx_car_drive_off" => "car_drive_off",
        "sfx_car_door" => "car_door",
        "sfx_beach" => "beach",
        "sfx_photo" => "shutterfilm",
        "sfx_kei_arrive" => "kei_arrive",
        "sfx_clap" => "clap",
        "sfx_pothole" => "pothole",
        "sfx_sliding_door" => "sliding_door",
        "sfx_creaking_door" => "creaking_door",
        "sfx_wood_floor" => "wood_floor",
        "sfx_footsteps_hard" => "footsteps_hard",
        "sfx_brook" => "brook",
        "sfx_crickets" => "crickets",
        "sfx_twig_snap" => "twig_snap",
        "sfx_forest" => "forest",

        'sfx_4lslogo' => '4lsaudiologo',
        'sfx_warningbell' => 'chaimu',
        'sfx_crunchydeath' => 'crunch',
        'sfx_impact2' => 'wumph_2',
        'sfx_heartfast' => 'heart_single_fast',
        'sfx_heartslow' => 'heart_single_slow',
        'sfx_heartstop' => 'heart_stop',
        'sfx_crowd_cheer' => 'crowd_cheer',
        'sfx_skid' => 'skid2',
        'sfx_gymbounce' => 'emibounce',
        'sfx_paper' => 'paperruffling',
        'sfx_draw' => 'sword_draw',
        'sfx_door_creak' => 'door_creak',
        'sfx_footsteps_soft' => 'footsteps_soft',
        'sfx_wumph2' => 'wumph_2',

        'sfx_crash' => 'crash',
        'sfx_hammer2' => 'hammer2',
        'sfx_smkgen_broken' => 'smkgen_broken',
    ],

    /** Виды позиций */
    'positions' => [
        'center' => PositionDto::make('center', 'center'),

        'right' => PositionDto::make('right', 'center'),
        'tworight' => PositionDto::make('right', 'center'),
        'bgright' => PositionDto::make('right', 'center'),
        'offscreenright' => PositionDto::make('right-in', 'center'),

        'left' => PositionDto::make('left', 'center'),
        'twoleft' => PositionDto::make('left', 'center'),
        'bgleft' => PositionDto::make('left', 'center'),
        'offscreenleft' => PositionDto::make('left-in', 'center')
    ]
];
