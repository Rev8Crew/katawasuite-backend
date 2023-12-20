<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DISK', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'admin' => [
            'driver' => 'local',
            'root' => storage_path('app/custom/admin'),
            'url' => env('APP_URL').'/storage/admin',
            'visibility' => 'public',
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],

        'fileStore' => [
            'driver' => 'local',
            'root' => storage_path('app/custom/files'),
            'url' => env('APP_URL').'/storage/files',
            'visibility' => 'public',
        ],

        'custom' => [
            'driver' => 'local',
            'root' => storage_path('app/custom'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),

        public_path('games/cp/background') => public_path('games/ks/background'),
        public_path('games/cp/font') => public_path('games/ks/font'),
        public_path('games/cp/foreground') => public_path('games/ks/foreground'),
        public_path('games/cp/sound') => public_path('games/ks/sound'),
        public_path('games/cp/video') => public_path('games/ks/video'),

        public_path('games/misha_route/background') => public_path('games/ks/background'),
        public_path('games/misha_route/font') => public_path('games/ks/font'),
        public_path('games/misha_route/foreground') => public_path('games/ks/foreground'),
        public_path('games/misha_route/sound') => public_path('games/ks/sound'),
        public_path('games/misha_route/video') => public_path('games/ks/video'),

        public_path('games/ksa/background') => public_path('games/ks/background'),
        public_path('games/ksa/font') => public_path('games/ks/font'),
        public_path('games/ksa/foreground') => public_path('games/ks/foreground'),
        public_path('games/ksa/sound') => public_path('games/ks/sound'),
        public_path('games/ksa/video') => public_path('games/ks/video'),

        public_path('games/letter_to_venus/background') => public_path('games/ks/background'),
        public_path('games/letter_to_venus/font') => public_path('games/ks/font'),
        public_path('games/letter_to_venus/foreground') => public_path('games/ks/foreground'),
        public_path('games/letter_to_venus/sound') => public_path('games/ks/sound'),
        public_path('games/letter_to_venus/video') => public_path('games/ks/video'),
    ],

];
