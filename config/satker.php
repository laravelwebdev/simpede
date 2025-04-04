<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Nama Kabupaten
    |--------------------------------------------------------------------------
    */

    'kabupaten' => env('SATKER_KABUPATEN', 'Kabupaten Hulu Sungai Tengah'),

    /*
    |--------------------------------------------------------------------------
    | Alamat Kantor
    |--------------------------------------------------------------------------
    */

    'alamat' => env('SATKER_ALAMAT', 'Jalan Keramat Manjang No. 10'),

    /*
    |--------------------------------------------------------------------------
    | Telepon Kantor
    |--------------------------------------------------------------------------
    */

    'telepon' => env('SATKER_TELP', '(0517) 41236'),

    /*
    |--------------------------------------------------------------------------
    | Lokasi Kantor/ Ibukota Kabupaten
    |--------------------------------------------------------------------------
    |
    | Wilayah yang akan digunakan pada keterangan tempat tanda tangan
    |
    */

    'ibukota' => env('SATKER_IBUKOTA', 'Barabai'),

    /*
    |--------------------------------------------------------------------------
    | Website BPS
    |--------------------------------------------------------------------------
    */

    'website' => env('SATKER_WEBSITE', 'https://hulusungaitengahkab.bps.go.id'),

    /*
    |--------------------------------------------------------------------------
    | Email BPS
    |--------------------------------------------------------------------------
    */

    'email' => env('SATKER_EMAIL', 'bps607@bps.go.id'),

    /*
    |--------------------------------------------------------------------------
    | Kode Satker
    |--------------------------------------------------------------------------
    |
    | Kode satker pada kementerian keuangan
    |
    */

    'kode' => env('SATKER_KODE', '428578'),

    /*
    |--------------------------------------------------------------------------
    | Kode Wilayah Satker
    |--------------------------------------------------------------------------
    |
    | Kode wilayah satker pada kementerian keuangan
    |
    */

    'wilayah' => env('SATKER_WILAYAH', '15.00'),

    /*
    |--------------------------------------------------------------------------
    | Rekening Satker
    |--------------------------------------------------------------------------
    |
    |Nomor Rekening Satker/Bendahara
    |
    */

    'rekening' => env('SATKER_REKENING', '652074285781000'),

];
