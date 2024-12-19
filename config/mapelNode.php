<?php

class Mapel
{
    public $mapelId;
    public $mapelNama;
    public $mapelDeskripsi;
    public $kelasId;

    public function __construct($mapelId, $mapelNama, $mapelDeskripsi, $kelasId)
    {
        $this->mapelId = $mapelId;
        $this->mapelNama = $mapelNama;
        $this->mapelDeskripsi = $mapelDeskripsi;
        $this->kelasId = $kelasId;
    }
}
