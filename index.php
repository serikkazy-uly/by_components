<?php
require_once 'Database.php';

Database::getInstatnce();

//  With condition - will not show
Database::getInstatnce(); 
Database::getInstatnce();
