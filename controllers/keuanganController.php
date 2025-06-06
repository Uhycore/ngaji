<?php
require_once 'database/koneksi.php';

require_once 'models/keuanganModel.php';
require_once 'models/santriModel.php';

class KeuanganController
{
    protected $keuanganModel;
    protected $santriModel;

    public function __construct($mysqli)
    {
        $this->keuanganModel = new KeuanganModel($mysqli);
        $this->santriModel = new SantriModel($mysqli);
    }
    public function listKeuangans()
    {
        try {
            $keuanganNodes = $this->keuanganModel->getAllKeuangan();
            include 'views/items/keuanganList.php';
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function inputKeuangans()
    {
        try {
            $santris = $this->santriModel->getAllSantri();
            include 'views/items/keuanganInput.php';
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function addKeuangans()
    {
        try {
            $santriId = $_POST['santriId'];
            $tanggal = $_POST['tanggal'];
            $nominal = $_POST['nominal'];

            $detailKeuanganData = [];

            foreach ($tanggal as $key => $tgl) {
                $detailKeuanganNode = new DetailKeuanganNode($key + 1, $tgl, $nominal[$key]);
                $detailKeuanganData[] = $detailKeuanganNode;
            }

            if (!empty($detailKeuanganData)) {
                $this->keuanganModel->addKeuangan($santriId, $detailKeuanganData);
                header("Location: index.php?modul=keuangan");
            } else {
                throw new Exception("Detail keuangan tidak lengkap!");
            }
        } catch (Exception $e) {
            echo "<script>
            alert('Error: " . $e->getMessage() . "');
            window.history.back();
        </script>";
        }
    }
}
