<?php
session_start();

require_once 'Database.php';
require_once 'Config.php';
require_once 'Input.php';
require_once 'Validate.php';
require_once 'Token.php';
require_once 'Session.php';
require_once 'User.php';
require_once 'Redirect.php';

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
        'toke_name' => 'token'
    ]
];
// echo Config::get('mysql.host');


// Redirect::to('test.php');
Redirect::to(404);

// Validation (passed or error)
if (Input::exists() && Token::check(Input::get('token'))) {

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

    if ($validate->passed()) {
        $user = new User;
        $user->create(
            [
                'username' => Input::get('username'),
                'password' => password_hash(Input::get('password'), PASSWORD_DEFAULT)
            ]);

        Session::flash('success', 'register success');
        // header('Location: test.php');
        // Redirect::to('test.php');
        // Redirect::to(404);

    } else {
        foreach ($validate->errors() as $error) {
            echo $error . "<br>";
        }
    }
}

?>

<form action="" method="post">
    <?php echo Session::flash('success'); ?>
    <div class="field">
        <label for="username">Username</label>
        <input type="text" name="username" value="<?php echo Input::get('username') ?>">
    </div>

    <div class="field">
        <label for="">Password</label>
        <input type="text" name="password">
    </div>

    <div class="field">
        <label for="">Password Again</label>
        <input type="text" name="password_again">
    </div>

    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">

    <div class="field">
        <button type="submit">Submit</button>
    </div>
</form>