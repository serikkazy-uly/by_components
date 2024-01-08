<?php

class Database
{
    private static $instance = null;
    private $pdo;

    private function __construct()
    {
        try {
            $this->pdo = new PDO('mysql:host=mysql; dbname=components', 'root', 'secret');
            echo 123;
        } catch (PDOException $exeption) {
            die($exeption->getMessage());
        }
    }

    public static function getInstatnce() 
    {
        if (!isset(self::$instance)) {
            self::$instance = new Database();
        }
        return self::$instance;
    }
}
