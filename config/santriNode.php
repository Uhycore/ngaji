<?php
require_once 'userNode.php';

class Santri extends User
{
    public $santriId;
    public $santriJenisKelamin;
    public $santriTempatTglLahir;
    public $santriAlamat;
    public $santriNamaOrtu;
    public $santriNoTelpOrtu;
    public $santriGajiOrtu;

    public function __construct($userId, $username, $password, Role $role, $santriId, $santriJenisKelamin, $santriTempatTglLahir, $santriAlamat, $santriNamaOrtu, $santriNoTelpOrtu, $santriGajiOrtu)
    {
        parent::__construct($userId, $username, $password, $role);

        $this->santriId = $santriId;
        $this->santriJenisKelamin = $santriJenisKelamin;
        $this->santriTempatTglLahir = $santriTempatTglLahir;
        $this->santriAlamat = $santriAlamat;
        $this->santriNamaOrtu = $santriNamaOrtu;
        $this->santriNoTelpOrtu = $santriNoTelpOrtu;
        $this->santriGajiOrtu = $santriGajiOrtu;
    }
}
