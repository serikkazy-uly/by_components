<?php

class User
{
    private $db, $data, $session_name;
    public function __construct()
    {
        $this->db = Database::getInstatnce();
        $this->session_name = Config::get('session.user_session');
    }

    public function create($fields = [])
    {
        $this->db->insert('users', $fields);
    }


    public function login($email = null, $password = null)
    {
        if ($email) {
            $user = $this->find($email);
            if ($user) {
                if (password_verify($password, $this->data->password)) {
                    // var_dump(password_verify($password, $this->data->password));exit; //bool: 
                    Session::put($this->session_name, $this->data->id);
                    return true;
                }
            }
        }
        return false;
    }

    public function find($email = null)
    {
        if ($email) {
            $this->data = $this->db->get('users', ['email', '=', $email])->first();
            if ($this->data) {
                return true;
            }
            return false;
        }
    }

    public function data()
    {
        return $this->data;
    }
}
