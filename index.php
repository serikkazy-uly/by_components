<?php
require_once 'init.php';
// session_start();

// var_dump($_SESSION);

echo Session::flash('success') . '<br>';
// var_dump(Session::flash('success')); // NULL

$user = new User;
if ($user->isLoggedIn()) {
    echo "Hi, <a href='#'>{$user->data()->username}</a>";
    echo "<p> <a href='logout.php'>Logout</a> </p>";
    echo "<p> <a href='update.php'>Update profile</a> </p>";
    echo "<p> <a href='change_password.php'>Change password</a> </p>";

 if($user->hasPermissions('admin')){
    echo 'You are admin';
}

} else {
    echo "<a href='login.php'>Login</a> or <a href='register.php'>Register</a>";
}
