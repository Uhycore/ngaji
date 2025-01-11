<?php
require_once 'interface.php';
require_once 'models/guruModel.php';

class GuruController implements userControllerInterface
{
    private $guruModel;

    public function __construct()
    {
        $this->guruModel = new GuruModel();
    }

    public function listUsers()
    {
        try {
            $gurus = $this->guruModel->getAllGurus();
            include 'views/guru/guruList.php';
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function addUser()
    {
        try {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $jenisKelamin = $_POST['jenisKelamin'];
            $tempatTglLahir = $_POST['tempatTglLahir'];
            $alamat = $_POST['alamat'];
            $noTelp = $_POST['noTelp'];

            $this->guruModel->addGuru($username, $password, 2, $jenisKelamin, $tempatTglLahir, $alamat, $noTelp);

            echo "<script>
                    alert('Guru berhasil ditambahkan!');
                    window.location.href = 'index.php?modul=guru&fitur=list';
                  </script>";
        } catch (Exception $e) {
            echo "<script>
                    alert('Gagal menambahkan Guru. Silakan coba lagi.');
                    window.history.back();
                  </script>";
        }
        exit;
    }

    public function editById()
    {
        $guruId = $_GET['guruId'];
        $objGuru = $this->guruModel->getGuruById($guruId);
        include 'views/guru/guruUpdate.php';
    }

    public function updateUser()
    {
        try {
            $guruId = $_POST['guruId'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $jenisKelamin = $_POST['jenisKelamin'];
            $tempatTglLahir = $_POST['tempatTglLahir'];
            $alamat = $_POST['alamat'];
            $noTelp = $_POST['noTelp'];

            $this->guruModel->updateGuru($guruId, $username, $password, 2, $jenisKelamin, $tempatTglLahir, $alamat, $noTelp);

            echo "<script>
                alert('Guru berhasil diperbarui!');
                window.location.href = 'index.php?modul=guru&fitur=list';
              </script>";
        } catch (Exception $e) {
            echo "<script>
                alert('Gagal memperbarui data Guru. Silakan coba lagi.');
                window.location.href = 'index.php?modul=guru&fitur=edit&guruId={$guruId}';
              </script>";
        }
        exit;
    }


    public function deleteUser()
    {
        try {
            $guruId = $_POST['guruId'];
            $this->guruModel->deleteGuru($guruId);

            echo "<script>
                    alert('Guru berhasil dihapus!');
                    window.location.href = 'index.php?modul=guru&fitur=list';
                  </script>";
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        exit;
    }
}
