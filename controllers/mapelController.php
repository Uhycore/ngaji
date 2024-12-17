<?php
require_once 'models/mapelModel.php';

class MapelController
{
    protected $mapelModel;

    public function __construct()
    {
        $this->mapelModel = new MapelModel();
    }

    public function listMapels()
    {
        try {
            $Mapels = $this->mapelModel->getAllmapel();
            include 'views/items/mapelList.php';
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function addMapels()
    {
        try {
            $mapelNama = $_POST['mapelNama'];
            $mapelDeskripsi = $_POST['mapelDeskripsi'];
            $this->mapelModel->addMapel($mapelNama, $mapelDeskripsi);

            echo "<script>
                    alert('Data mapel berhasil ditambahkan!');
                    window.location.href = 'index.php?modul=mapel&fitur=list';
                 </script>";
            header('location: index.php?modul=mapel&fitur=list');
        } catch (Exception $e) {
            echo "<script>
                    alert('Gagal menambahkan data mapel. Error: " . $e->getMessage() . "');
                    window.history.back();
                 </script>";
        }
    }

    public function editById()
    {
        try {
            $mapelId = $_GET['mapelId'];
            $objMapels = $this->mapelModel->getMapelById($mapelId);

            include 'views/items/mapelUpdate.php';
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function updateMapels()
    {
        try {
            $mapelId = $_POST['mapelId'];
            $mapelNama = $_POST['mapelNama'];
            $mapelDeskripsi = $_POST['mapelDeskripsi'];
            $this->mapelModel->updateMapel($mapelId, $mapelNama, $mapelDeskripsi);
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
    }
}
