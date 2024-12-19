<?php

require_once 'models/nilaiModel.php';
require_once 'models/santriModel.php';
require_once 'models/mapelModel.php';
require_once 'models/kelasModel.php';

class NilaiController
{
    public $nilaiModel;
    protected $santriModel;
    protected $mapelModel;
    private $kelasModel;

    public function __construct()
    {
        $this->nilaiModel = new NilaiModel();
        $this->santriModel = new SantriModel();
        $this->mapelModel = new MapelModel();
        $this->kelasModel = new KelasModel();
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
        $objNilai = null;
        $hasil = [];
        $santris = $this->santriModel->getAllSantri();

        if (isset($_GET['santriId'])) {
            $santriId = $_GET['santriId'];

            $objNilai = $this->nilaiModel->getNilaiBySantriId($santriId);
            $santri = $this->santriModel->getSantriById($santriId);

            $objMapels = $this->mapelModel->getAllmapel();

            foreach ($objMapels as $mapel) {
                if ($mapel->kelasId['id'] == $santri['idKelas']['id']) { 
                    $hasil[] = $mapel;
                }
            }
        } else {
            $hasil = $this->mapelModel->getAllmapel();
            include 'views/items/nilaiInput.php';
            exit;
        }

        include 'views/items/nilaiInput.php';

        exit;
    }




    public function addNilais()
    {
        try {
            $santriId = $_POST['santriId'];
            $mapelId = $_POST['mapelId'];
            $nilais = $_POST['nilai'];

            // Menyusun detail nilai
            $detail_nilai_data = [];
            $counter = 1;
            foreach ($mapelId as $key => $mapel_id) {
                $mapel = $this->mapelModel->getMapelById($mapel_id);

                if ($mapel) {
                    $detailNilaiNode = new DetailNilaiNode($counter++, $mapel, $nilais[$key]);
                    $detail_nilai_data[] = $detailNilaiNode;
                }
            }

            // Menambahkan atau memperbarui data nilai
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
