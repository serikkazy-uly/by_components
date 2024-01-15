<?php
require_once 'init.php';

$user = new User; // get current user
$user->logout();
Redirect::to('index.php');
