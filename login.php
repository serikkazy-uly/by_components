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
            // var_dump(Input::get('password'));
            $user = new User;
            $remember = (Input::get('remember')) === 'on' ? true : false; //if click true else false
            $login = $user->login(Input::get('email'), Input::get('password'), $remember);

            if ($login) {
                Redirect::to('index.php'); //login successful
            } else {
                // var_dump($login);
                echo 'login failed';
                // For debaging (temp echo: )
                echo '<br>' . '<br>';
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
    <div class="field">
        <label for="remember">Remember me</label>
        <input type="checkbox" name="remember" id="remember">
    </div>

    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">

    <div class="field">
        <button type="submit">Submit</button>
    </div>
</form>