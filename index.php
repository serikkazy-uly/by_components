<?php
require_once 'Database.php';
require_once 'Config.php';

$GLOBALS['config'] = [
    'mysql' => [
        'host' => 'mysql',
        'username' => 'user',

        'password' => 'secret',

        'database' => 'app',

        'something' => [
            'no' => [
                'foo' => [
                    'bar' => 'baz'
                ]
            ],
        ]
    ],
    'config_my' =>[]
];

echo Config::get('mysql.something.no.foo.bar');
// $users = Database::getInstatnce()->query('users', ['select * from users']);
// var_dump($users->results());

// $users = Database::getInstatnce()->query("SELECT * FROM users WHERE username IN  (?, ?) ", ['Damir', 'Fara']);

//--------------> Get
// $users = Database::getInstatnce()->get('users', ['username', '=',  'Fara']);
// $users = Database::getInstatnce()->get('users', ['password', '=',  'password1']);
  
// if ($users->error()) {
//     echo 'Error';
// } else {
//     // echo 'OK'; 
//     foreach ($users->results() as $user) {
//         echo $user->username . '<br>';
//     }
// }

//-------------->Delete
// $users = Database::getInstatnce()->delete('users', ['password', '=',  'pswd1']);
// $users = Database::getInstatnce()->delete('users', ['username', '=',  'q']);

//-------------->Insert
// Database::getInstatnce()->insert('users', [
//     'username'=> 'Kahoot',  
//     'password' => '123',
//     'email' => 'asd1'
// ]);   


//--------------> Update
// $id = 150;
// Database::getInstatnce()->update('users', $id, [
//     'username' => 'Kahoot1',  
//     'password' => 'asd1'
// ]);  


//Выборка пользователя
// $users = Database::getInstatnce()->get('users', ['username', '=',  'Fara']);
// var_dump('<pre>');
// var_dump($users->results()[0]);
// var_dump('</pre>');

// echo $users->first()->username; // Only one user
// echo $users->first()->password; 

// echo $users->results()[0]->username; // All users