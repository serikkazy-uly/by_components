<?php

class Database
{
    private static $instance = null;
    private $pdo, $query, $error = false, $results, $count;

    private function __construct()
    {
        try {
            $host = Config::get('mysql.host');
            $database = Config::get('mysql.database');
            $username = Config::get('mysql.username');
            $password = Config::get('mysql.password');

            $this->pdo = new PDO("mysql:host={$host};dbname={$database}", $username, $password);
            // $this->pdo = new PDO("mysql:host=" . Config::get('mysql.host') . "; dbname=" . Config::get('mysql.database'), Config::get('mysql.username'), Config::get('mysql.password'));
            // $this->pdo = new PDO("mysql:host=mysql; dbname=app", 'root', 'secret');
        } catch (PDOException $exeption) {
            die($exeption->getMessage());
        }
    }

    // Create our instance
    public static function getInstatnce()
    {
        if (!isset(self::$instance)) {
            self::$instance = new Database();
        }
        return self::$instance;
    }
    // Execute sql request
    public function query($sql, $params = [])
    {
        $this->error = false;
        $this->query = $this->pdo->prepare($sql);

        if (count($params)) {
            $i = 1;

            foreach ($params as $param) {
                $this->query->bindValue($i, $param);
                $i++;
            }
        }

        if (!$this->query->execute()) {
            $this->error = true;
        } else {
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

    // Getting all values (записи) from table
    public function get($table, $where = [])
    {
        return $this->action('SELECT *', $table, $where);
    }

    // Delete all values (записи) from table

    public function delete($table, $where = [])
    {
        return $this->action('DELETE', $table, $where);
    }

    // Обертка или звено м/у get && delete
    public function action($action, $table, $where = [])
    {
        if (count($where) === 3) {
            $operators = ['=', '>', '<', '>=', '<='];
            $field = $where[0];
            $operator = $where[1];
            $value = $where[2];

            if (in_array($operator, $operators)) {

                $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";
                if (!$this->query($sql, [$value])->error()) {
                    return $this;
                }
            }
        }
        return false;
    }


    public function insert($table, $fields = [])
    {
        $values = '';
        foreach ($fields as $field) {
            $values .= "?, ";
        }
        // var_dump($field);die;

        $values = rtrim($values, ', ');
        $sql = "INSERT INTO {$table} (`" . implode('` , `', array_keys($fields)) . "`) VALUES (" . $values . ")";
        //    var_dump($sql);die;
        if (!$this->query($sql, $fields)->error()) {
            return true;
        }
        return false;
    }


    public function update($table, $id, $fields = [])
    {
        $set = '';
        foreach ($fields as $key => $field) {
            $set .= "{$key} = ?, "; // username = ?, password = ?,
        }

        $set = rtrim($set, ', '); // username = ?, password = ?
        // echo $set;die;

        $sql = "UPDATE {$table} SET {$set} WHERE id = {$id}";
        //    var_dump($sql);die;
        if (!$this->query($sql, $fields)->error()) {
            return true;
        }
        return false;
    }

    public function first()
    {
        return $this->results()[0];
        // $results = $this->results();
        // return isset($results[0]) ? $results[0] : null;
    }
}
