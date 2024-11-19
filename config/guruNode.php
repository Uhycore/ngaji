<?php
require_once 'userNode.php';

class Guru extends User
{
    public $guruId;
    public $guruJenisKelamin;
    public $guruTempatTglLahir;
    public $guruKelas;
    public $guruAlamat;
    public $guruNoTelp;


    public function __construct($userId, $username, $password, Role $role, $guruId, $guruJenisKelamin, $guruTempatTglLahir, $guruKelas, $guruAlamat, $guruNoTelp)
    {
        parent::__construct($userId, $username, $password, $role);

        $this->guruId = $guruId;
        $this->guruJenisKelamin = $guruJenisKelamin;
        $this->guruTempatTglLahir = $guruTempatTglLahir;
        $this->guruKelas = $guruKelas;
        $this->guruAlamat = $guruAlamat;
        $this->guruNoTelp = $guruNoTelp;
    }
}
