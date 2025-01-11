<?php
require_once 'models/absenModel.php';
require_once 'models/kelasModel.php';
require_once 'models/santriModel.php';

class AbsenController
{
    private $absenModel;
    private $kelasModel;
    private $santriModel;

    public function __construct()
    {
        $this->absenModel = new AbsenModel();
        $this->kelasModel = new KelasModel();
        $this->santriModel = new SantriModel();
    }

    public function listAbsen()
    {
        try {
            $idGuru = $_SESSION['username_login']['id'];
            if (!$idGuru) {
                throw new Exception('Guru tidak ditemukan dalam sesi.');
            }

            $kelasList = $this->kelasModel->getKelasByGuruId($idGuru);
            $santris = $this->santriModel->getSantriByKelasId($kelasList['id']);

            $hasil = [];
            foreach ($santris as $santri) {
                if ($santri['idKelas']['id'] == $kelasList['id']) {
                    $absens = $this->absenModel->getAbsenBySantriId($santri['id']);
                    if ($absens) {
                        
                        foreach ($absens as $absen) {
                            $hasil[] = $absen;
                        }
                    }
                }
            }

            include 'views/absen/absenList.php';
        } catch (Exception $e) {
            echo "<script>alert('Error saat menampilkan daftar absen: " . $e->getMessage() . "');</script>";
        }
    }





    public function inputAbsen()
    {
        try {
            $idGuru = $_SESSION['username_login']['id'];
            if (!$idGuru) {
                throw new Exception('Guru tidak ditemukan dalam sesi.');
            }

            $kelasList = $this->kelasModel->getKelasByGuruId($idGuru);
            $santriList = $this->santriModel->getAllSantri();

            $hasil = [];
            foreach ($santriList as $santri) {
                if (isset($santri['idKelas']['id']) && $santri['idKelas']['id'] == $kelasList['id']) {
                    $hasil[] = $santri;
                }
            }

            include 'views/absen/absenInput.php';
        } catch (Exception $e) {
            echo "<script>alert('Error saat menampilkan form input absen: " . $e->getMessage() . "');</script>";
        }
    }

    public function addAbsen()
    {
        try {
            $idSantri = $_POST['idSantri'] ?? [];
            $tanggal = $_POST['tanggal'];

            if (empty($idSantri)) {
                throw new Exception('Pilih minimal satu santri untuk diabsen.');
            }

            if (!$tanggal) {
                throw new Exception('Tanggal absen wajib diisi.');
            }

            foreach ($idSantri as $santriId) {
                $this->absenModel->addAbsen($santriId, $tanggal);
            }

            echo "<script>
                alert('Data absen berhasil ditambahkan!');
                window.location.href = 'index.php?modul=absen&fitur=list'; 
            </script>";
        } catch (Exception $e) {
            echo "<script>
                alert('Error saat menambahkan data absen: " . $e->getMessage() . "');
                window.history.back();
            </script>";
        }
    }
    public function deleteAbsen()
    {
        try {
            $idAbsen = $_POST['idAbsen'];
            $this->absenModel->deleteAbsen($idAbsen);
            echo "<script>
                alert('Data absen berhasil dihapus!');
                window.location.href = 'index.php?modul=absen&fitur=list'; 
            </script>";
        } catch (Exception $e) {
            echo "<script>
                alert('Error saat menghapus data absen: " . $e->getMessage() . "');
                window.history.back();
            </script>";
        }
    }

    public function editAbsen()
    {
        try {
            $idAbsen = $_GET['idAbsen'];
            $absen = $this->absenModel->getAbsenById($idAbsen);
            include 'views/absen/absenUpdate.php';
        } catch (Exception $e) {
            echo "<script>
                alert('Error saat mengedit data absen: " . $e->getMessage() . "');
                window.history.back();
            </script>";
        }
    }

    public function updateAbsen()
    {
        try {

            $idAbsen = $_POST['idAbsen'];
            $idSantri   = $_POST['idSantri'];
            $tanggal = $_POST['tanggal'];
            $this->absenModel->updateAbsen($idAbsen, $idSantri, $tanggal);
            echo "<script>
                alert('Data absen berhasil diubah!');
                window.location.href = 'index.php?modul=absen&fitur=list'; 
            </script>";
        } catch (Exception $e) {
            echo "<script>
                alert('Error saat mengubah data absen: " . $e->getMessage() . "');
                window.history.back();
            </script>";
        }
    }
}
