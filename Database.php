<?php

class Database
{
    private static $instance = null;
    private $pdo, $query, $error = false, $results, $count;

    private function __construct()
    {
        try {
            $this->pdo = new PDO('mysql:host=mysql; dbname=app', 'user', 'secret');
            // echo 'Users: ' . '<br>' . '<br>';
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

    public function query($sql, $params = [])
    {
        $this->error = false; 
        $this->query = $this->pdo->prepare($sql);

       if (count($params)){
            $i = 1;

            foreach($params as $param){
                $this->query->bindValue($i, $param);
                $i++;
            }
        }

        if (!$this->query->execute()) {
            $this->error = true;
        } else{ 
            $this->results = $this->query->fetchAll(PDO::FETCH_OBJ);
            $this->count = $this->query->rowCount();
        }
        return $this;
    }

    public function error()
    {
        return $this->error;
    }
    public function results()
    {
        return $this->results;
    }

    public function count()
    {
        return $this->count;
    }
}
