<?php

class User
{
    private $db;
    public function __construct()
    {
        $this->db = Database::getInstatnce();
    }

    public function create($fields = [])
    {
        $this->db->insert('users', $fields);
    }
}
