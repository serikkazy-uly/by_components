<?php
require_once 'init.php';

// var_dump(Session::get('user'));
if (Input::exists()) { // check input
    if (Token::check(Input::get('token'))) { // check token

        $validate = new Validate();

        $validate->check($_POST, [ // check validation
            'email' => [ // it is name of field
                'required' => true,
                'email' => true // it is name of rule validation
            ],
            'password' => [
                'required' => true
            ]
        ]);

        if ($validate->passed()) {
            $user = new User;
            $login = $user->login(
                Input::get('email'),
                Input::get('password')
            );

            if ($login) {
                echo 'login successful';
            } else {
                echo 'login failed';
                echo '<br>';
                echo 'Email: ' . Input::get('email');
                echo '<br>';
                echo 'Password: ' . Input::get('password');
            }
            
        } else {
            foreach ($validate->errors() as $error) {
                echo $error . '<br>';
            }
        }
    }
}
?>

<form action="" method="post">

    <div class="field">
        <label for="email">Email</label>
        <input type="text" name="email" value="<?php echo Input::get('email') ?>">
    </div>
    <div class="field">
        <label for="">Password</label>
        <input type="password" name="password">
    </div>

    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">

    <div class="field">
        <button type="submit">Submit</button>
    </div>
</form>