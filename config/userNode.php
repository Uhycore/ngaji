<?php
require_once 'roleNode.php';

class User
{
    public $userId;
    public $username;
    public $password;
    public $role;

    public function __construct($userId, $username, $password, Role $role)
    {
        $this->userId = $userId;
        $this->username = $username;
        $this->password = $password;
        $this->role = $role;
    }
}
