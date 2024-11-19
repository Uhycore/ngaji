<?php
require_once 'userNode.php';

class Admin extends User
{
    public $adminId;
    public $adminJenisKelamin;
    public $adminAlamat;
    public $adminNoTelp;



    public function __construct($userId, $username, $password, Role $role, $adminId, $adminJenisKelamin, $adminAlamat, $adminNoTelp)
    {
        parent::__construct($userId, $username, $password, $role);

        $this->adminId = $adminId;
        $this->adminJenisKelamin = $adminJenisKelamin;
        $this->adminAlamat = $adminAlamat;
        $this->adminNoTelp = $adminNoTelp;
    }
}
