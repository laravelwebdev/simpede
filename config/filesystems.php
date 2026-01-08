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
            'serve' => true,
            'throw' => false,
            'report' => false,
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
            'throw' => false,
            'report' => false,
        ],

        'avatars' => [
            'driver' => 'local',
            'root' => storage_path('app/public/avatars'),
            'url' => env('APP_URL').'/storage/avatars',
            'visibility' => 'public',
            'throw' => false,
            'report' => false,
        ],

        'arsip' => [
            'driver' => 'local',
            'root' => storage_path('app/public/arsip'),
            'url' => env('APP_URL').'/storage/arsip',
            'visibility' => 'public',
            'throw' => false,
            'report' => false,
        ],

        'images' => [
            'driver' => 'local',
            'root' => storage_path('app/public/images'),
            'url' => env('APP_URL').'/storage/images',
            'visibility' => 'public',
            'throw' => false,
            'report' => false,
        ],

        'naskah' => [
            'driver' => 'local',
            'root' => storage_path('app/public/naskah'),
            'url' => env('APP_URL').'/storage/naskah',
            'visibility' => 'public',
            'throw' => false,
            'report' => false,
        ],

        'announcement' => [
            'driver' => 'local',
            'root' => storage_path('app/public/announcement'),
            'url' => env('APP_URL').'/storage/announcement',
            'visibility' => 'public',
            'throw' => false,
            'report' => false,
        ],

        'template_naskah' => [
            'driver' => 'local',
            'root' => storage_path('app/public/templates/naskah'),
            'url' => env('APP_URL').'/storage/templates/naskah',
            'visibility' => 'public',
            'throw' => false,
            'report' => false,
        ],

        'templates' => [
            'driver' => 'local',
            'root' => storage_path('app/public/templates'),
            'url' => env('APP_URL').'/storage/templates',
            'visibility' => 'public',
            'throw' => false,
            'report' => false,
        ],

        'izin_keluar' => [
            'driver' => 'local',
            'root' => storage_path('app/public/izinkeluar'),
            'url' => env('APP_URL').'/storage/izinkeluar',
            'visibility' => 'public',
            'throw' => false,
            'report' => false,
        ],

        'pulsa' => [
            'driver' => 'local',
            'root' => storage_path('app/public/pulsa'),
            'url' => env('APP_URL').'/storage/pulsa',
            'visibility' => 'public',
            'throw' => false,
            'report' => false,
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
            'report' => false,
        ],

        'susenas' => [
            'driver' => 'local',
            'root' => storage_path('app/public/susenas'),
            'url' => env('APP_URL').'/storage/susenas',
            'visibility' => 'public',
            'throw' => false,
            'report' => false,
        ],


        'temp' => [
            'driver' => 'local',
            'root' => storage_path('app/public/.temp'),
            'url' => env('APP_URL').'/storage/.temp',
            'visibility' => 'public',
            'throw' => false,
            'report' => false,
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
            'report' => false,
        ],
        'google' => [
            'driver' => 'google',
            'clientId' => env('GOOGLE_DRIVE_CLIENT_ID'),
            'clientSecret' => env('GOOGLE_DRIVE_CLIENT_SECRET'),
            'refreshToken' => env('GOOGLE_DRIVE_REFRESH_TOKEN'),
            'folder' => env('GOOGLE_DRIVE_FOLDER'),
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
