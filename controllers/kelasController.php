<?php
require_once 'models/kelasModel.php';
require_once 'models/guruModel.php';

class kelasController
{
    private $kelasModel;
    private $guruModel;

    public function __construct()
    {
        $this->kelasModel = new kelasModel();
        $this->guruModel = new GuruModel();
    }

    public function listKelas()
    {
        try {
            $kelasList = $this->kelasModel->getAllKelas();
            include 'views/items/kelasList.php';
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function inputKelas()
    {
        try {
            $gurus = $this->guruModel->getAllGurus();
            include 'views/items/kelasInput.php';
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function addKelas()
    {
        try {
            $namaKelas = $_POST['namaKelas'];
            $guruId = $_POST['guruId'];

            $this->kelasModel->addKelas($namaKelas, $guruId);

            echo "<script>
                    alert('kelas berhasil ditambahkan!');
                    window.location.href = 'index.php?modul=kelas&fitur=list';
                  </script>";
        } catch (Exception $e) {
            echo "<script>
                    alert('Gagal menambahkan kelas . Silakan coba lagi.');
                    window.history.back();
                  </script>";
        }
        exit;
    }

    public function editKelas()
    {
        $idKelas = $_GET['idKelas'];
        $kelas = $this->kelasModel->getKelasById($idKelas);
        $gurus = $this->guruModel->getAllGurus();
        include 'views/items/kelasUpdate.php';
    }

    public function updateKelas()
    {
        try {
            $idKelas = $_POST['idKelas'];
            $namaKelas = $_POST['namaKelas'];
            $guruId = $_POST['guruId'];

            $this->kelasModel->updateKelas($idKelas, $namaKelas, $guruId);

            echo "<script>
                    alert('kelas  berhasil diperbarui!');
                    window.location.href = 'index.php?modul=kelas&fitur=list';
                  </script>";
        } catch (Exception $e) {
            echo "<script>
                    alert('Gagal memperbarui kelas . Silakan coba lagi.');
                    window.location.href = 'index.php?modul=kelas&fitur=edit&idKelas={$idKelas}';
                  </script>";
        }
        exit;
    }

    public function deleteKelas()
    {
        try {
            $idKelas = $_POST['idKelas'];
            $this->kelasModel->deleteKelas($idKelas);

            echo "<script>
                    alert('kelas  berhasil dihapus!');
                    window.location.href = 'index.php?modul=kelas&fitur=list';
                  </script>";
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        exit;
    }
}
