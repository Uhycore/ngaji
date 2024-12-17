<?php
require_once 'roleModel.php';

class SantriModel
{
    private $mysqli;
    private $roleModel;

    public function __construct()
    {
        $this->mysqli = new mysqli('localhost', 'root', '', 'tpq');

        if ($this->mysqli->connect_error) {
            die("Connection failed: " . $this->mysqli->connect_error);
        }

        $this->roleModel = new RoleModel();
        $result = $this->mysqli->query("SELECT COUNT(*) FROM santris");
        $count = $result->fetch_row()[0];

        if ($count == 0) {
            $this->initializeDefaultSantri();
        }
    }

    public function initializeDefaultSantri()
    {
        $this->addSantri('Arilsantri', '1', 3, 'Laki-laki', 'Jakarta, 2000-01-01', 'Jl. Raya Jakarta', 'Aril', '0123456789', 1000000);
        $this->addSantri('Mubinsantri', '1', 3, 'Laki-laki', 'Jakarta, 2001-02-02', 'Jl. Raya Jakarta', 'Mubin', '0123456789', 1200000);
    }

    public function addSantri($username, $password, $roleId, $santriJenisKelamin, $santriTempatTglLahir, $santriAlamat, $santriNamaOrtu, $santriNoTelpOrtu, $santriGajiOrtu)
    {
        $stmt = $this->mysqli->prepare("INSERT INTO santris (username, password, roleId, santriJenisKelamin, santriTempatTglLahir, santriAlamat, santriNamaOrtu, santriNoTelpOrtu, santriGajiOrtu) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssisssssi", $username, $password, $roleId, $santriJenisKelamin, $santriTempatTglLahir, $santriAlamat, $santriNamaOrtu, $santriNoTelpOrtu, $santriGajiOrtu);
        $stmt->execute();
        $stmt->close();
    }

    public function getAllSantri()
    {
        $result = $this->mysqli->query("SELECT * FROM santris");
        $santris = [];

        while ($row = $result->fetch_assoc()) {
            $role = $this->roleModel->getRoleById(3);
            $santris[] = [
                'santriId' => $row['santriId'],
                'username' => $row['username'],
                'password' => $row['password'],
                'roleId' => $role,
                'santriJenisKelamin' => $row['santriJenisKelamin'],
                'santriTempatTglLahir' => $row['santriTempatTglLahir'],
                'santriAlamat' => $row['santriAlamat'],
                'santriNamaOrtu' => $row['santriNamaOrtu'],
                'santriNoTelpOrtu' => $row['santriNoTelpOrtu'],
                'santriGajiOrtu' => $row['santriGajiOrtu']
            ];
        }

        return $santris;
    }

    public function getSantriById($santriId)
    {
        $stmt = $this->mysqli->prepare("SELECT * FROM santris WHERE santriId = ?");
        $stmt->bind_param("i", $santriId);
        $stmt->execute();
        $result = $stmt->get_result();
        $santri = $result->fetch_assoc();
        $stmt->close();

        if ($santri) {
            $role = $this->roleModel->getRoleById(3);

            return [
                'santriId' => $santri['santriId'],
                'username' => $santri['username'],
                'password' => $santri['password'],
                'roleId' => $role,
                'santriJenisKelamin' => $santri['santriJenisKelamin'],
                'santriTempatTglLahir' => $santri['santriTempatTglLahir'],
                'santriAlamat' => $santri['santriAlamat'],
                'santriNamaOrtu' => $santri['santriNamaOrtu'],
                'santriNoTelpOrtu' => $santri['santriNoTelpOrtu'],
                'santriGajiOrtu' => $santri['santriGajiOrtu']
            ];
        }

        return null;
    }


    public function getSantriByUsername($username)
    {
        $stmt = $this->mysqli->prepare("SELECT * FROM santris WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $santri = $result->fetch_assoc();
        $stmt->close();

        return $santri;
    }

    public function updateSantri($santriId, $username, $password, $santriJenisKelamin, $santriTempatTglLahir, $santriAlamat, $santriNamaOrtu, $santriNoTelpOrtu, $santriGajiOrtu)
    {
        $stmt = $this->mysqli->prepare("UPDATE santris SET username = ?, password = ?, santriJenisKelamin = ?, santriTempatTglLahir = ?, santriAlamat = ?, santriNamaOrtu = ?, santriNoTelpOrtu = ?, santriGajiOrtu = ? WHERE santriId = ?");
        $stmt->bind_param("sssssssii", $username, $password, $santriJenisKelamin, $santriTempatTglLahir, $santriAlamat, $santriNamaOrtu, $santriNoTelpOrtu, $santriGajiOrtu, $santriId);
        $stmt->execute();
        $stmt->close();
    }

    public function deleteSantri($santriId)
    {
        $stmt = $this->mysqli->prepare("DELETE FROM santris WHERE santriId = ?");
        $stmt->bind_param("i", $santriId);
        $stmt->execute();
        $stmt->close();
    }
}
