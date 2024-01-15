<?php
require_once 'init.php';

// var_dump(Session::get(Config::get('session.user_session')));

$user = new User; // get current user
// $anotherUser = new User(157); // get another user

//  $user->data()->username;
// echo $anotherUser->data()->username;


if ($user->isLoggedIn()) {
    echo "Hi, <a href='#'>{$user->data()->username}</a>";
    echo "<p> <a href='logout.php'>Logout</a> </p>";
} else {
    echo "<a href='login.php'>Login</a> or <a href='register.php'>Register</a>";
}
