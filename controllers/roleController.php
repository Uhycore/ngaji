<?php

require_once 'models/roleModel.php';

class RoleController
{
    private $roleModel;

    public function __construct()
    {
        $this->roleModel = new RoleModel();
    }

    public function listRoles()
    {
        try {
            $Roles = $this->roleModel->getAllRoles();
           
            include 'views/role/roleList.php';
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function addRoles()
    {
        try {
            $roleNama = trim($_POST['roleNama']);
            $roleDeskripsi = trim($_POST['roleDeskripsi']);
            $roleStatus = $_POST['roleStatus'];

            $this->roleModel->addRole($roleNama, $roleDeskripsi, $roleStatus);

            echo "<script>
                    alert('Data role berhasil ditambahkan!');
                    window.location.href = 'index.php?modul=role&fitur=list'; 
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
            $roleId = $_GET['roleId'];
            $objRoles = $this->roleModel->getRoleById($roleId);

            include 'views/role/roleUpdate.php';
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function updateRoles()
    {
        try {
            $roleId = $_POST['roleId'];
            $roleNama = trim($_POST['roleNama']);
            $roleDeskripsi = trim($_POST['roleDeskripsi']);
            $roleStatus = $_POST['roleStatus'];

            $this->roleModel->updateRole($roleId, $roleNama, $roleDeskripsi, $roleStatus);

            echo "<script>
                    alert('Data role berhasil diperbarui!');
                    window.location.href = 'index.php?modul=role&fitur=list'; 
                 </script>";
        } catch (Exception $e) {
            echo "<script>
                    alert('Gagal memperbarui data role. Error: " . $e->getMessage() . "');
                    window.location.href = 'index.php?modul=role&fitur=edit&roleId={$roleId}'; 
                </script>";
        }
        exit;
    }

    public function deleteRoles()
    {
        try {
            $roleId = $_POST['roleId'];

            $this->roleModel->deleteRole($roleId);

            echo "<script>
                    alert('Data role berhasil dihapus!');
                    window.location.href = 'index.php?modul=role&fitur=list'; 
                 </script>";
        } catch (Exception $e) {
            echo "<script>
                    alert('Gagal menghapus role: " . $e->getMessage() . "');
                    window.location.href = 'index.php?modul=role&fitur=list';
                 </script>";
        }
        exit;
    }
}
