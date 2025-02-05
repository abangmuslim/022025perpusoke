<?php

return [

    'defaults' => [
        'guard' => 'web', // Pastikan default guard sesuai kebutuhan
        'passwords' => 'admin', // Sesuaikan dengan provider yang ada
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'admin',
        ],

        'peminjam' => [
            'driver' => 'session',
            'provider' => 'peminjam',
        ],
    ],

    'providers' => [
        'admin' => [
            'driver' => 'eloquent',
            'model' => App\Models\Admin::class,
        ],

        'peminjam' => [
            'driver' => 'eloquent',
            'model' => App\Models\Peminjam::class,
        ],
    ],


    'passwords' => [
        'admin' => [
            'provider' => 'admin',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
        'peminjam' => [
            'provider' => 'peminjam',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,

];
