<?php

class Mapel
{
    public $mapelId;
    public $mapelNama;
    public $mapelDeskripsi;

    public function __construct($mapelId, $mapelNama, $mapelDeskripsi)
    {
        $this->mapelId = $mapelId;
        $this->mapelNama = $mapelNama;
        $this->mapelDeskripsi = $mapelDeskripsi;
    }
}
