<?php

require_once 'models/nilaiModel.php';
require_once 'models/santriModel.php';
require_once 'models/mapelModel.php';

class NilaiController
{
    public $nilaiModel;
    protected $santriModel;
    protected $mapelModel;

    public function __construct()
    {
        $this->nilaiModel = new NilaiModel();
        $this->santriModel = new SantriModel();
        $this->mapelModel = new MapelModel();
    }

    public function listNilais()
    {
        try {
            $nilaiNodes = $this->nilaiModel->getAllNilai();
            include 'views/items/nilaiList.php';
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        exit;
    }


    public function inputNilais()
    {
        try {
            $santris = $this->santriModel->getAllSantri();
            $mapels = $this->mapelModel->getAllmapel();
            include 'views/items/nilaiInput.php';
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        exit;
    }

    public function addNilais()
    {
        try {
            $santriId = $_POST['santriId'];
            $mapelId = $_POST['mapelId'];
            $nilais = $_POST['nilai'];


            $detail_nilai_data = [];
            $counter = 1;
            foreach ($mapelId as $key => $mapel_id) {
                $mapel = $this->mapelModel->getMapelById($mapel_id);

                if ($mapel) {
                    $detailNilaiNode = new DetailNilaiNode($counter++, $mapel, $nilais[$key]);
                    $detail_nilai_data[] = $detailNilaiNode;
                }
            }

            if (!empty($detail_nilai_data)) {
                $this->nilaiModel->addNilai($santriId, $detail_nilai_data);
                header("Location: index.php?modul=nilai");
            } else {
                throw new Exception("Detail nilai tidak lengkap!");
            }
        } catch (Exception $e) {
            echo "<script>
                    alert('Error: " . $e->getMessage() . "');
                    window.history.back();
                 </script>";
        }
        exit;
    }
}
