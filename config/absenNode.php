<?php
class Absen
{
    public $id;
    public $idSantri;
    public $tanggal;


    public function __construct($id, $idSantri, $tanggal)
    {
        $this->id = $id;
        $this->idSantri = $idSantri;
        $this->tanggal = $tanggal;
       
    }
}
