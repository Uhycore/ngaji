<?php
require_once 'models/santriModel.php';
require_once 'models/kelasModel.php';

class SantriController
{
    private $santriModel;
    private $kelasModel;

    public function __construct()
    {
        $this->santriModel = new SantriModel();
        $this->kelasModel = new KelasModel();
    }

    public function listSantri()
    {
        try {
            $santris = $this->santriModel->getAllSantri();
            include 'views/santri/santriList.php';
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function inputSantri(){
        try {
            $kelas = $this->kelasModel->getAllKelas();
            include 'views/santri/santriInput.php';
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function addSantri()
    {
        try {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $santriJenisKelamin = $_POST['santriJenisKelamin'];
            $santriTempatTglLahir = $_POST['santriTempatTglLahir'];
            $santriAlamat = $_POST['santriAlamat'];
            $santriNamaOrtu = $_POST['santriNamaOrtu'];
            $santriNoTelpOrtu = $_POST['santriNoTelpOrtu'];
            $santriGajiOrtu = $_POST['santriGajiOrtu'];
            $idKelas = $_POST['idKelas']; // Get the idKelas from POST data

            // Adding the new Santri along with the idKelas
            $this->santriModel->addSantri($username, $password, 3, $santriJenisKelamin, $santriTempatTglLahir, $santriAlamat, $santriNamaOrtu, $santriNoTelpOrtu, $santriGajiOrtu, $idKelas);

            echo "<script>
                    alert('Santri berhasil ditambahkan!');
                    window.location.href = 'index.php?modul=santri&fitur=list'; 
                  </script>";
        } catch (Exception $e) {
            echo "<script>
                    alert('Gagal menambahkan Santri. Error: " . $e->getMessage() . "');
                    window.history.back();
                  </script>";
        }
        exit;
    }

    public function editById()
    {
        try {
            $santriId = $_GET['santriId'];
            $objSantri = $this->santriModel->getSantriById($santriId);
            $kelas = $this->kelasModel->getAllKelas();
            include 'views/santri/santriUpdate.php';
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function updateSantri()
    {
        try {
            $santriId = $_POST['santriId'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $santriJenisKelamin = $_POST['santriJenisKelamin'];
            $santriTempatTglLahir = $_POST['santriTempatTglLahir'];
            $santriAlamat = $_POST['santriAlamat'];
            $santriNamaOrtu = $_POST['santriNamaOrtu'];
            $santriNoTelpOrtu = $_POST['santriNoTelpOrtu'];
            $santriGajiOrtu = $_POST['santriGajiOrtu'];
            $idKelas = $_POST['idKelas']; // Get idKelas for update

            // Updating Santri data including idKelas
            $this->santriModel->updateSantri($santriId, $username, $password, $santriJenisKelamin, $santriTempatTglLahir, $santriAlamat, $santriNamaOrtu, $santriNoTelpOrtu, $santriGajiOrtu, $idKelas);

            echo "<script>
                    alert('Santri berhasil diperbarui!');
                    window.location.href = 'index.php?modul=santri&fitur=list'; 
                  </script>";
        } catch (Exception $e) {
            echo "<script>
                    alert('Gagal memperbarui data Santri. Error: " . $e->getMessage() . "');
                    window.location.href = 'index.php?modul=santri&fitur=edit&santriId={$santriId}'; 
                  </script>";
        }
        exit;
    }

    public function deleteSantri()
    {
        try {
            $santriId = $_POST['santriId'];
            $this->santriModel->deleteSantri($santriId);

            echo "<script>
                    alert('Santri berhasil dihapus!');
                    window.location.href = 'index.php?modul=santri&fitur=list'; 
                  </script>";
        } catch (Exception $e) {
            echo "<script>
                    alert('Gagal menghapus santri. Error: " . $e->getMessage() . "');
                    window.history.back();
                  </script>";
        }
        exit;
    }
}
