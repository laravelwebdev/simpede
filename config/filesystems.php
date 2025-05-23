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

        'avatars' => [
            'driver' => 'local',
            'root' => storage_path('app/public/avatars'),
            'url' => env('APP_URL').'/storage/avatars',
            'visibility' => 'public',
            'throw' => false,
        ],

        'arsip' => [
            'driver' => 'local',
            'root' => storage_path('app/public/arsip'),
            'url' => env('APP_URL').'/storage/arsip',
            'visibility' => 'public',
            'throw' => false,
        ],

        'images' => [
            'driver' => 'local',
            'root' => storage_path('app/public/images'),
            'url' => env('APP_URL').'/storage/images',
            'visibility' => 'public',
            'throw' => false,
        ],

        'naskah' => [
            'driver' => 'local',
            'root' => storage_path('app/public/naskah'),
            'url' => env('APP_URL').'/storage/naskah',
            'visibility' => 'public',
            'throw' => false,
        ],

        'template_naskah' => [
            'driver' => 'local',
            'root' => storage_path('app/public/templates/naskah'),
            'url' => env('APP_URL').'/storage/templates/naskah',
            'visibility' => 'public',
            'throw' => false,
        ],

        'templates' => [
            'driver' => 'local',
            'root' => storage_path('app/public/templates'),
            'url' => env('APP_URL').'/storage/templates',
            'visibility' => 'public',
            'throw' => false,
        ],

        'izin_keluar' => [
            'driver' => 'local',
            'root' => storage_path('app/public/izinkeluar'),
            'url' => env('APP_URL').'/storage/izinkeluar',
            'visibility' => 'public',
            'throw' => false,
        ],

        'dokumentasi' => [
            'driver' => 'local',
            'root' => storage_path('app/public/dokumentasi'),
            'url' => env('APP_URL').'/storage/dokumentasi',
            'visibility' => 'public',
            'throw' => false,
        ],

        'sakip' => [
            'driver' => 'local',
            'root' => storage_path('app/public/sakip'),
            'url' => env('APP_URL').'/storage/sakip',
            'visibility' => 'public',
            'throw' => false,
        ],

        'temp' => [
            'driver' => 'local',
            'root' => storage_path('app/public/.temp'),
            'url' => env('APP_URL').'/storage/.temp',
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
    ],

];
