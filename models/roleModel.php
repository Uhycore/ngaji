<?php
require_once 'config/roleNode.php';

class RoleModel
{
    private $mysqli;

    public function __construct()
    {
        $this->mysqli = new mysqli('localhost', 'root', '', 'tpq');

        if ($this->mysqli->connect_error) {
            die("Connection failed: " . $this->mysqli->connect_error);
        }

        $result = $this->mysqli->query("SELECT COUNT(*) FROM roles");
        $count = $result->fetch_row()[0];

        if ($count == 0) {
            $this->initializeDefaultRole();
        }
    }

    public function initializeDefaultRole()
    {
        $defaultRoles = [
            ["Admin", "Sebagai pengatur semuanya", 1],
            ["Uztad/Uztadzah", "Bagian menginputkan data", 1],
            ["Santri", "Santri/Orang tua santri yang memiliki akun", 1],
            ["Bendahara", "Menginputkan data keuangan", 1]
        ];

        foreach ($defaultRoles as $role) {
            $this->addRole($role[0], $role[1], $role[2]);
        }
    }

    public function addRole($roleNama, $roleDeskripsi, $roleStatus)
    {
        $stmt = $this->mysqli->prepare("INSERT INTO roles (roleNama, roleDeskripsi, roleStatus) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $roleNama, $roleDeskripsi, $roleStatus);
        $stmt->execute();
        $stmt->close();
    }

    public function getAllRoles()
    {
        $result = $this->mysqli->query("SELECT * FROM roles");
        $roles = [];

        while ($row = $result->fetch_assoc()) {
            $roles[] = new Role(
                $row['roleId'],
                $row['roleNama'],
                $row['roleDeskripsi'],
                $row['roleStatus']
            );
        }

        return $roles;
    }

    public function getRoleById($roleId)
    {
        $stmt = $this->mysqli->prepare("SELECT * FROM roles WHERE roleId = ?");
        $stmt->bind_param("i", $roleId);
        $stmt->execute();
        $result = $stmt->get_result();
        $role = $result->fetch_assoc();
        $stmt->close();

        if ($role) {
            return new Role(
                $role['roleId'],
                $role['roleNama'],
                $role['roleDeskripsi'],
                $role['roleStatus']
            );
        }

        return null;
    }

    public function updateRole($roleId, $roleNama, $roleDeskripsi, $roleStatus)
    {
        $stmt = $this->mysqli->prepare("UPDATE roles SET roleNama = ?, roleDeskripsi = ?, roleStatus = ? WHERE roleId = ?");
        $stmt->bind_param("ssii", $roleNama, $roleDeskripsi, $roleStatus, $roleId);
        $stmt->execute();
        $stmt->close();
    }

    public function deleteRole($roleId)
    {
        $stmt = $this->mysqli->prepare("DELETE FROM roles WHERE roleId = ?");
        $stmt->bind_param("i", $roleId);
        $stmt->execute();
        $stmt->close();
    }

    public function getRoleByName($roleNama)
    {
        $stmt = $this->mysqli->prepare("SELECT * FROM roles WHERE roleNama = ?");
        $stmt->bind_param("s", $roleNama);
        $stmt->execute();
        $result = $stmt->get_result();
        $role = $result->fetch_assoc();
        $stmt->close();

        if ($role) {
            return new Role(
                $role['roleId'],
                $role['roleNama'],
                $role['roleDeskripsi'],
                $role['roleStatus']
            );
        }

        return null;
    }

    public function resetRoles()
    {
        $this->mysqli->query("DELETE FROM roles");
        $this->mysqli->query("ALTER TABLE roles AUTO_INCREMENT = 1");
    }
}
