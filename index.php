<?php
require_once 'Database.php';
require_once 'Config.php';
require_once 'Input.php';
require_once 'Validate.php';

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
    'config_my' => []
];

// Validation (passed or error)
if (Input::exists()) {
    $validate = new Validate();

    $validate = $validate->check($_POST, [
        'username' => [
            'required' => true,
            'min' => 2,
            'max' => 15,
            'unique' => 'users'
        ],

        'password' => [
            'required' => true,
            'min' => 3,

        ],

        'password_again' => [
            'required' => true,
            'matches' => 'password',

        ]

    ]);
    
    if($validation->passed()){
        echo 'passed';
    } else {
        foreach($validation->errors() as $error){
            echo $error . "<br>";
        }
    }
}

?>


<form action="" method="post">
    <div class="field">
        <label for="username">Username</label>
        <input type="text" name="username" value="<?php echo Input::get('username')?>">
    </div>


    <div class="field">
        <label for="">Password</label>
        <input type="text" name="password">
    </div>

    <div class="field">
        <label for="">Password Again</label>
        <input type="text" name="password_again">
    </div>
    <div class="field">
        <button type="submit">Submit</button>
    </div>

