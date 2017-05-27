<?php

/*
 * This file is part of Laravel Hashids.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Default Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the connections below you wish to use as
    | your default connection for all work. Of course, you may use many
    | connections at once using the manager class.
    |
    */

    'default' => 'main',

    /*
    |--------------------------------------------------------------------------
    | Hashids Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the connections setup for your application. Example
    | configuration has been included, but you may add as many connections as
    | you would like.
    |
    */

    'connections' => [

        'main' => [
            'salt' => 'your-salt-string',
            'length' => 'your-length-integer',
        ],

        'user' => [
            'salt' => 'Bismillahirrohmanirrohim',
            'length' => '6',
            'alphabet' => 'USER1234567890PNGA',
        ],

        'lembaga' => [
            'salt' => 'Alhamdulillahirobbilalamin',
            'length' => '10',
            'alphabet' => 'LEMBAG1234567890',
        ],
        'anggaran' => [
            'salt' => 'Malikiyaumiddin',
            'length' => '3',
            'alphabet' => 'JABTN1234567890SD',
        ],
        'agenda' => [
            'salt' => 'Iyyakana"buduWaiyyakanastain',
            'length' => '6',
            'alphabet' => 'PERSONALI1234567890',
        ],
        'audit' => [
            'salt' => 'Ihdinashhirotholmustaqim',
            'length' => '6',
            'alphabet' => 'RIWAYTPENDK1234567890',
        ],
        'rdk' => [
            'salt' => 'Shirothalladzinaanamtaalaihim',
            'length' => '6',
            'alphabet' => 'KONTAkonta1234567890',
        ],
        'keuangan' => [
            'salt' => 'GhoirilMaghdlubialaihimwaadldlallin',
            'length' => '6',
            'alphabet' => 'ALMTalmt1234567890',
        ],
        'disposisi' => [
            'salt' => 'Robbighfirliwaliwalidayyawalilmukmininaamin',
            'length' => '6',
            'alphabet' => 'RIWAYTOGNS1234567890',
        ],
        'pelantikan' => [
            'salt' => 'Aliflammim',
            'length' => '10',
            'alphabet' => 'PELANTIK1234567890',
        ],
    ],

];
