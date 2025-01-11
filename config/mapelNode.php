<?php

abstract class BaseEntity
{

    abstract public function getInfo();
}

class Mapel extends BaseEntity
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

    public function getInfo()
    {
        return [
            'mapelId' => $this->mapelId,
            'mapelNama' => $this->mapelNama,
            'mapelDeskripsi' => $this->mapelDeskripsi,
            'kelasId' => $this->kelasId,
        ];
    }
}

