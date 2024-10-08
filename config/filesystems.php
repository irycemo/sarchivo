<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application for file storage.
    |
    */

    'default' => env('FILESYSTEM_DISK', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Below you may configure as many filesystem disks as necessary, and you
    | may even configure multiple disks for the same driver. Examples for
    | most supported storage drivers are configured here for reference.
    |
    | Supported drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
            'throw' => false,
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
            'throw' => false,
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
            'throw' => false,
        ],

        'predios_catastro' => [
            'driver' => 'local',
            'root' => storage_path('app/predios_catastro'),
            'url' => env('APP_URL').'/predios_catastro',
            'visibility' => 'public',
            'throw' => false,
        ],

        'tomos_catastro' => [
            'driver' => 'local',
            'root' => storage_path('app/tomos_catastro'),
            'url' => env('APP_URL').'/tomos_catastro',
            'visibility' => 'public',
            'throw' => false,
        ],

        'legajos_catastro' => [
            'driver' => 'local',
            'root' => storage_path('app/legajos_catastro'),
            'url' => env('APP_URL').'/legajos_catastro',
            'visibility' => 'public',
            'throw' => false,
        ],

        'carpetas' => [
            'driver' => 'local',
            'root' => storage_path('app/carpetas'),
            'url' => env('APP_URL').'/carpetas',
            'visibility' => 'public',
            'throw' => false,
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
        public_path('predios_catastro') => storage_path('app/predios_catastro'),
        public_path('tomos_catastro') => storage_path('app/tomos_catastro'),
        public_path('legajos_catastro') => storage_path('app/legajos_catastro'),
        public_path('carpetas') => storage_path('app/carpetas'),
    ],

];
