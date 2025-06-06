<?php
require_once 'database/koneksi.php';

require_once 'roleModel.php';

class AdminModel
{
    private $mysqli;
    private $roleModel;

    public function __construct($mysqli)
    {
        $this->mysqli = $mysqli;

        if ($this->mysqli->connect_error) {
            die("Connection failed: " . $this->mysqli->connect_error);
        }

        $this->roleModel = new RoleModel($mysqli);

        $result = $this->mysqli->query("SELECT COUNT(*) FROM admins");
        $count = $result->fetch_row()[0];

        if ($count == 0) {
            $this->initializeDefaultAdmins();
        }
    }

    public function initializeDefaultAdmins()
    {
        $this->addAdmin('Ariladmin', '1', 1, "Laki-laki", 'Jl. Raya Jakarta', '0123456789');
        $this->addAdmin('Mubinadmin', '1', 1, "Perempuan", 'Jl. Raya Jakarta', '0123456789');
    }

    public function addAdmin($username, $password, $roleId, $adminJenisKelamin, $alamat, $noTelp)
    {
        $stmt = $this->mysqli->prepare("INSERT INTO admins (username, password, roleId, adminJenisKelamin, adminAlamat, adminNoTelp) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssisss", $username, $password, $roleId, $adminJenisKelamin, $alamat, $noTelp);
        $stmt->execute();
        $stmt->close();
    }

    public function getAllAdmins()
    {
        $result = $this->mysqli->query("SELECT * FROM admins");
        $admins = [];

        while ($row = $result->fetch_assoc()) {
            $role = $this->roleModel->getRoleById(1);
            $admins[] = [
                'adminId' => $row['adminId'],
                'username' => $row['username'],
                'password' => $row['password'],
                'roleId' => $role,
                'adminJenisKelamin' => $row['adminJenisKelamin'],
                'adminAlamat' => $row['adminAlamat'],
                'adminNoTelp' => $row['adminNoTelp']
            ];
        }

        return $admins;
    }

    public function getAdminById($adminId)
    {
        $stmt = $this->mysqli->prepare("SELECT * FROM admins WHERE adminId = ?");
        $stmt->bind_param("i", $adminId);
        $stmt->execute();
        $result = $stmt->get_result();
        $admin = $result->fetch_assoc();
        $stmt->close();

        if ($admin) {
            $role = $this->roleModel->getRoleById(1);

            return [
                'adminId' => $admin['adminId'],
                'username' => $admin['username'],
                'password' => $admin['password'],
                'roleId' => $role,
                'adminJenisKelamin' => $admin['adminJenisKelamin'],
                'adminAlamat' => $admin['adminAlamat'],
                'adminNoTelp' => $admin['adminNoTelp']
            ];
        }

        return null;
    }

    public function getAdminByUsername($username)
    {
        $stmt = $this->mysqli->prepare("SELECT * FROM admins WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $admin = $result->fetch_assoc();
        $stmt->close();

        return $admin;
    }

    public function updateAdmin($adminId, $username, $password, $adminJenisKelamin, $alamat, $noTelp)
    {
        $stmt = $this->mysqli->prepare("UPDATE admins SET username = ?, password = ?, adminJenisKelamin = ?, adminAlamat = ?, adminNoTelp = ? WHERE adminId = ?");
        $stmt->bind_param("sssssi", $username, $password, $adminJenisKelamin, $alamat, $noTelp, $adminId);
        $stmt->execute();
        $stmt->close();
    }

    public function deleteAdmin($adminId)
    {
        $stmt = $this->mysqli->prepare("DELETE FROM admins WHERE adminId = ?");
        $stmt->bind_param("i", $adminId);
        $stmt->execute();
        $stmt->close();
    }
}
