<?php
require_once 'init.php';

$user = new User;
$validate = new Validate();

$validate->check($_POST, [
    'username' => [
        'required' => true,
        'min' => 2
    ]
    
]);
// var_dump($_POST);

if (Input::exists()) { // check input
    if (Token::check(Input::get('token'))) { // check token
        if ($validate->passed()) {
            $user->update(['username' => Input::get('username')]);
            Session::flash('success', 'name has been updated! ');
            Redirect::to('index.php');

            // Redirect::to('update.php');
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
        <label for="username">Username</label>
        <input type="text" name="username" id="username" value="<?php echo $user->data()->username; ?>">
    </div>
    <div class="field">
        <button type="submit">Submit</button>
    </div>
    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
</form>