<?php
require_once 'database/koneksi.php';

require_once 'models/bendaharaModel.php';

class BendaharaController
{
    private $bendaharaModel;

    public function __construct($mysqli)
    {
        $this->bendaharaModel = new BendaharaModel($mysqli);
    }

    public function listBendaharas()
    {
        try {
            $bendaharas = $this->bendaharaModel->getAllBendaharas();
            include 'views/bendahara/bendaharaList.php';
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function addBendaharas()
    {
        try {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $jenisKelamin = $_POST['jenisKelamin'];
            $tempatTglLahir = $_POST['tempatTglLahir'];
            $kelas = $_POST['kelas'];
            $alamat = $_POST['alamat'];
            $noTelp = $_POST['noTelp'];

            $this->bendaharaModel->addBendahara($username, $password, 4, $jenisKelamin, $tempatTglLahir, $kelas, $alamat, $noTelp);

            echo "<script>
                    alert('bendahara berhasil ditambahkan!');
                    window.location.href = 'index.php?modul=bendahara&fitur=list';
                  </script>";
        } catch (Exception $e) {
            echo "<script>
                    alert('Gagal menambahkan bendahara. Silakan coba lagi.');
                    window.history.back();
                  </script>";
        }
        exit;
    }

    public function editById()
    {
        $bendaharaId = $_GET['bendaharaId'];
        $objBendahara = $this->bendaharaModel->getBendaharaById($bendaharaId);
        include 'views/bendahara/bendaharaUpdate.php';
    }

    public function updateBendaharas()
    {
        try {
            $bendaharaId = $_POST['bendaharaId'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $jenisKelamin = $_POST['jenisKelamin'];
            $tempatTglLahir = $_POST['tempatTglLahir'];
            $kelas = $_POST['kelas'];
            $alamat = $_POST['alamat'];
            $noTelp = $_POST['noTelp'];

            $this->bendaharaModel->updateBendahara($bendaharaId, $username, $password, $jenisKelamin, $tempatTglLahir, $kelas, $alamat, $noTelp);

            echo "<script>
                    alert('bendahara berhasil diperbarui!');
                    window.location.href = 'index.php?modul=bendahara&fitur=list';
                  </script>";
        } catch (Exception $e) {
            echo "<script>
                    alert('Gagal memperbarui data bendahara. Silakan coba lagi.');
                    window.location.href = 'index.php?modul=bendahara&fitur=edit&bendaharaId={$bendaharaId}'; 
                  </script>";
        }
        exit;
    }

    public function deleteBendaharas()
    {
        try {
            $bendaharaId = $_POST['bendaharaId'];
            $this->bendaharaModel->deleteBendahara($bendaharaId);

            echo "<script>
                    alert('bendahara berhasil dihapus!');
                    window.location.href = 'index.php?modul=bendahara&fitur=list';
                  </script>";
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        exit;
    }
}
