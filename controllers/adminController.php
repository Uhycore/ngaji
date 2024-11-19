<?php

require_once 'models/adminModel.php';

class AdminController
{
    private $adminModel;

    public function __construct()
    {
        $this->adminModel = new AdminModel();
    }

    public function listAdmins()
    {
        try {
            $admins = $this->adminModel->getAllAdmins();
            include 'views/admin/adminList.php';
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function addAdmins()
    {
        try {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $jenisKelamin = $_POST['jenisKelamin'];
            $alamat = $_POST['alamat'];
            $noTelp = $_POST['noTelp'];

            $this->adminModel->addAdmin($username, $password, 1, $jenisKelamin, $alamat, $noTelp);

            echo "<script>
                    alert('Data admin berhasil ditambahkan!');
                    window.location.href = 'index.php?modul=admin&fitur=list'; 
                 </script>";
        } catch (Exception $e) {
            echo "<script>
                    alert('Gagal menambahkan data role. Error: " . $e->getMessage() . "');
                    window.history.back();
                 </script>";
        }
        exit;
    }

    public function editById()
    {
        try {
            $adminId = $_GET['adminId'];
            $objAdmin = $this->adminModel->getAdminById($adminId);

            include 'views/admin/adminUpdate.php';
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function updateAdmins()
    {
        try {
            $adminId = $_POST['adminId'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $jenisKelamin = $_POST['jenisKelamin'];
            $alamat = $_POST['alamat'];
            $noTelp = $_POST['noTelp'];

            $this->adminModel->updateAdmin($adminId, $username, $password, $jenisKelamin, $alamat, $noTelp);

            echo "<script>
                    alert('Data admin berhasil diperbarui!');
                    window.location.href = 'index.php?modul=admin&fitur=list'; 
                </script>";
        } catch (Exception $e) {
            echo "<script>
                    alert('Gagal memperbarui data role. Error: " . $e->getMessage() . "');
                    window.location.href = 'index.php?modul=admin&fitur=edit&adminId={$adminId}'; 
                </script>";
        }
        exit;
    }

    public function deleteAdmins()
    {
        try {
            $adminId = $_POST['adminId'];
            $this->adminModel->deleteAdmin($adminId);

            echo "<script>
                    alert('Data admin berhasil dihapus!');
                    window.location.href = 'index.php?modul=admin&fitur=list'; 
                </script>";

            exit;
        } catch (Exception $e) {

            echo "Gagal menghapus admin: " . $e->getMessage();
        }
        exit;
    }
}
