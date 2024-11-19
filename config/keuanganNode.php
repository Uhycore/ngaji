<?php
require_once 'detailKeuanganNode.php';

class KeuanganNode
{
    public $keuanganId;
    public $santri;
    public $detailKeuangan;

    public function __construct($keuanganId, $santri)
    {
        $this->keuanganId = $keuanganId;
        $this->santri = $santri;
        $this->detailKeuangan = [];
    }
}
