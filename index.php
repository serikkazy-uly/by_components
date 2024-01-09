<?php
include 'Database.php';

$users = Database::getInstatnce()->query("SELECT * FROM users WHERE username IN  (?, ?) ", ['Damir', 'Fara']);

if ($users->error()) {
    echo 'OOPS';
} else {
    // echo 'OK'; 
    foreach ($users->results() as $user) {
        echo $user->username . '<br>';
    }
}

// var_dump($users->count());die;
// die;

