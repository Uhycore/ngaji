<?php
require_once 'mapelNode.php';

class DetailNilaiNode
{
    public $detailNilaiId;
    public $mapel;
    public $nilai;

    public function __construct($detailNilaiId, Mapel $mapel, $nilai)
    {
        $this->detailNilaiId = $detailNilaiId;
        $this->mapel = $mapel;
        $this->nilai = $nilai;
    }
}
