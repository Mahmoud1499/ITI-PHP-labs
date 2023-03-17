<?php

class LoginHandler
{
    private $queryBuilder;
    private $user_entry_username;
    private $user_entry_password;
    private $sent_remember_me;

    public function __construct()
    {
        $this->queryBuilder = new QueryBuilderHandler("users");
    }
    public function add_remember_key($user, $pass)
    {
        $this->user_entry_username = $user;
        $this->user_entry_password = $pass;
        if ($this->validate_login_parameters()) {
            $rememberd_key = sha1(uniqid());
            if ($this->queryBuilder->check_existed($rememberd_key, "remember_key")) {
                setcookie("remember_me", $rememberd_key, __remembered_duration__);
            }
        }
    }
    private function validate_remember_key($key)
    {
        if (isset($_COOKIE["remember_me"]) && $this->queryBuilder->check_existed($_COOKIE["remember_me"], "remember_me")) {
            $this->sent_remember_me = $_COOKIE["remember_me"];
            return true;
        } else {
            return false;
        }
    }
    private function open_session_for_valid_remember_key()
    {
        $user_id = $this->queryBuilder->get_id($this->sent_remember_me, "remember_me");
        $_SESSION["user_id"] = $user_id;
    }
    public function validate_and_open_session_for_valid_remember_key($key)
    {
        if ($this->validate_remember_key($key)) {
            $this->open_session_for_valid_remember_key();
            return true;
        } else {
            return false;
        }
    }
    public function validate_login_parameters()
    {
        return true;
    }
}
