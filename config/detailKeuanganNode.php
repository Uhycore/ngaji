<?php
class DetailKeuanganNode
{
    public $detailKeuanganId;
    public $tanggal;
    public $nominal;

    public function __construct($detailKeuanganId, $tanggal, $nominal)
    {
        $this->detailKeuanganId = $detailKeuanganId;
        $this->tanggal = $tanggal;
        $this->nominal = $nominal;
    }
}
