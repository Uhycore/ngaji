<?php
require_once 'config/adminNode.php';

class AdminModel
{
    private $admins = [];
    private $nextIdAdmin = 1;
    private $roleModel;
    private $jsonFilePath = 'data/admins.json';

    public function __construct()
    {
        $this->roleModel = new RoleModel();

        if (file_exists($this->jsonFilePath)) {
            $this->loadFromJsonFile();
            $this->nextIdAdmin = $this->getMaxAdminId() + 1;
        } else {
            $this->initializeDefaultAdmin();
            $this->saveToJsonFile();
        }
    }

    public function initializeDefaultAdmin()
    {
        $this->addAdmin('Ariladmin', '1', 1, 'Laki-laki', 'Jl. Raya Jakarta', '0123456789');
        $this->addAdmin('Mubinadmin', '1', 1, 'Laki-laki', 'Jl. Raya Jakarta', '0123456789');
    }

    public function addAdmin($username, $password, $roleId, $jenisKelamin, $alamat, $noTelp)
    {
        $role = $this->roleModel->getRoleById($roleId);
        $admin = new Admin(1, $username, $password, $role, $this->nextIdAdmin++, $jenisKelamin, $alamat, $noTelp);
        $this->admins[] = $admin;
        $this->saveToJsonFile();
    }

    private function saveToJsonFile()
    {
        $adminData = array_map(function ($admin) {
            return [
                'userId' => $admin->userId,
                'username' => $admin->username,
                'password' => $admin->password,
                'role' => $admin->role,
                'adminId' => $admin->adminId,
                'adminJenisKelamin' => $admin->adminJenisKelamin,
                'adminAlamat' => $admin->adminAlamat,
                'adminNoTelp' => $admin->adminNoTelp,
            ];
        }, $this->admins);

        file_put_contents($this->jsonFilePath, json_encode($adminData, JSON_PRETTY_PRINT));
    }

    private function loadFromJsonFile()
    {
        $adminData = json_decode(file_get_contents($this->jsonFilePath), true);
        if (is_array($adminData)) {
            foreach ($adminData as $data) {
                $role = $this->roleModel->getRoleById($data['role']['roleId']);
                $admin = new Admin(
                    $data['userId'],
                    $data['username'],
                    $data['password'],
                    $role,
                    $data['adminId'],
                    $data['adminJenisKelamin'],
                    $data['adminAlamat'],
                    $data['adminNoTelp']
                );
                $this->admins[] = $admin;
            }
        }
    }

    public function getAllAdmins()
    {
        return $this->admins;
    }

    private function getMaxAdminId()
    {
        $maxId = 0;
        foreach ($this->admins as $admin) {
            if ($admin->adminId > $maxId) {
                $maxId = $admin->adminId;
            }
        }
        return $maxId;
    }

    public function getAdminById($adminId)
    {
        foreach ($this->admins as $admin) {
            if ($admin->adminId == $adminId) {
                return $admin;
            }
        }
        return null;
    }

    public function getAdminByUsername($username)
    {
        foreach ($this->admins as $admin) {
            if ($admin->username == $username) {
                return $admin;
            }
        }
        return null;
    }

    public function updateAdmin($adminId, $username, $password, $jenisKelamin, $alamat, $noTelp)
    {
        $admin = $this->getAdminById($adminId);
        if ($admin) {
            $admin->username = $username;
            $admin->password = $password;
            $admin->adminJenisKelamin = $jenisKelamin;
            $admin->adminAlamat = $alamat;
            $admin->adminNoTelp = $noTelp;
            $this->saveToJsonFile();
            return true;
        }
        return false;
    }

    public function deleteAdmin($adminId)
    {
        $admin = $this->getAdminById($adminId);
        $index = array_search($admin, $this->admins);
        if ($index !== false) {
            unset($this->admins[$index]);
            $this->admins = array_values($this->admins);
            $this->saveToJsonFile();
            return true;
        }
        return false;
    }
}
