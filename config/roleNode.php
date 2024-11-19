<?php
class Role
{
    public $roleId;
    public $roleNama;
    public $roleDeskripsi;
    public $roleStatus;


    public function __construct($roleId, $roleNama, $roleDeskripsi, $roleStatus)
    {
        $this->roleId = $roleId;
        $this->roleNama = $roleNama;
        $this->roleDeskripsi = $roleDeskripsi;
        $this->roleStatus = $roleStatus;
    }
}
