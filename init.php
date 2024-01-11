<?php
session_start();

require_once 'classes/Config.php';
require_once 'classes/Database.php';
require_once 'classes/Input.php';
require_once 'classes/Validate.php';
require_once 'classes/Token.php';
require_once 'classes/Session.php';
require_once 'classes/User.php';
require_once 'classes/Redirect.php';

$GLOBALS['config'] = [
    'mysql' => [
        'host' => 'mysql',
        'database' => 'app',
        'username' => 'root',
        'password' => 'secret',
        'something' => [
            'no' => [
                'foo' => [
                    'bar' => 'baz'
                ]
            ],
        ]
    ],
    'session' => [
        'toke_name' => 'token',
        'user_session' => 'user'

    ]
];
// echo Config::get('mysql.host');
// Redirect::to('test.php');
// Redirect::to(404);



