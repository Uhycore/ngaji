<?php
require_once 'database/koneksi.php';

require_once 'models/mapelModel.php';
require_once 'models/kelasModel.php';

class MapelController
{
    protected $mapelModel;
    protected $kelasModel;

    public function __construct($mysqli)
    {
        $this->mapelModel = new MapelModel($mysqli);
        $this->kelasModel = new KelasModel($mysqli);
    }

    public function listMapels()
    {
        try {
            $Mapels = $this->mapelModel->getAllmapel();
            include 'views/items/mapelList.php';
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        exit;
    }
    public function inputMapels()
    {
        try {
            $objKelas = $this->kelasModel->getAllKelas();
            include 'views/items/mapelInput.php';
        
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        exit;
    }

    public function addMapels()
    {
        try {
            $mapelNama = $_POST['mapelNama'];
            $mapelDeskripsi = $_POST['mapelDeskripsi'];
            $kelasId = $_POST['kelasId'];
            $this->mapelModel->addMapel($mapelNama, $mapelDeskripsi, $kelasId);

            echo "<script>
                    alert('Data mapel berhasil ditambahkan!');
                    window.location.href = 'index.php?modul=mapel&fitur=list';
                 </script>";

        } catch (Exception $e) {
            echo "<script>
                    alert('Gagal menambahkan data mapel. Error: " . $e->getMessage() . "');
                    window.history.back();
                 </script>";
        }
        exit;
    }

    public function editById()
    {
        try {
            $mapelId = $_GET['mapelId'];
            $objMapels = $this->mapelModel->getMapelById($mapelId);
            $objKelas = $this->kelasModel->getAllKelas();

            include 'views/items/mapelUpdate.php';
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        exit;
    }

    public function updateMapels()
    {
        try {
            $mapelId = $_POST['mapelId'];
            $mapelNama = $_POST['mapelNama'];
            $mapelDeskripsi = $_POST['mapelDeskripsi'];
            $kelasId = $_POST['kelasId'];
            $this->mapelModel->updateMapel($mapelId, $mapelNama, $mapelDeskripsi, $kelasId);
            echo "<script>
                        alert('Data mapel berhasil diperbarui!');
                        window.location.href = 'index.php?modul=mapel&fitur=list'; 
                      </script>";
        } catch (Exception $e) {
            echo "<script>
                    alert('Gagal memperbarui data mapel. Error: " . $e->getMessage() . "');
                    window.location.href = 'index.php?modul=mapel&fitur=edit&mapelId={$mapelId}'; 
                  </script>";
        }
        exit;
    }

    public function deleteMapels()
    {
        try {
            $mapelId = $_POST['mapelId'];
            $this->mapelModel->deleteMapel($mapelId);

            echo "<script>
                    alert('Data mapel berhasil dihapus!');
                    window.location.href = 'index.php?modul=mapel&fitur=list';
                 </script>";
        } catch (Exception $e) {
            echo "<script>
                    alert('Gagal menghapus data mapel. Error: " . $e->getMessage() . "');
                    window.location.href = 'index.php?modul=mapel&fitur=list';
                 </script>";
        }
        exit;
    }
}
