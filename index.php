<?php
require_once 'Database.php';

$users = Database::getInstatnce()->query("SELECT * FROM users");

// var_dump($users->count());die;

if ($users->error()) {
    echo 'OOPS';
} else {
    // echo 'kay'; 
    foreach ($users->results() as $user) {
        echo $user->username . '<br>';
    }
}

// die;

if (count($users->count())) {
}
