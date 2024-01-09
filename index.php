<?php
include 'Database.php';

// $users = Database::getInstatnce()->query("SELECT * FROM users WHERE username IN  (?, ?) ", ['Damir', 'Fara']);

$users = Database::getInstatnce()->get('users', ['username', '=',  'Fara']);
// $users = Database::getInstatnce()->get('users', ['password', '=',  'password1']);
  
if ($users->error()) {
    echo 'Error';
} else {
    // echo 'OK'; 
    foreach ($users->results() as $user) {
        echo $user->username . '<br>';
    }
}

//Delete
// $users = Database::getInstatnce()->delete('users', ['password', '=',  'pswd1']);
// $users = Database::getInstatnce()->delete('users', ['username', '=',  'q']);
