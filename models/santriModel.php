<?php
require_once 'roleModel.php';
require_once 'kelasModel.php';

class SantriModel
{
    private $mysqli;
    private $roleModel;
    private $kelasModel;

    public function __construct()
    {
        $this->mysqli = new mysqli('localhost', 'root', '', 'tpq');

        if ($this->mysqli->connect_error) {
            die("Connection failed: " . $this->mysqli->connect_error);
        }

        $this->roleModel = new RoleModel();
        $this->kelasModel = new KelasModel();

        $result = $this->mysqli->query("SELECT COUNT(*) FROM santris");
        $count = $result->fetch_row()[0];

        if ($count == 0) {
            $this->initializeDefaultSantri();
        }
    }

    public function initializeDefaultSantri()
    {
        $this->addSantri('Arilsantri', '1', 3, 'Laki-laki', 'Jakarta, 2000-01-01', 'Jl. Raya Jakarta', 'Aril', '0123456789', 1000000, 1);  // Add idKelas value here
        $this->addSantri('Mubinsantri', '1', 3, 'Laki-laki', 'Jakarta, 2001-02-02', 'Jl. Raya Jakarta', 'Mubin', '0123456789', 1200000, 2);  // Add idKelas value here
    }


    public function addSantri($username, $password, $roleId, $santriJenisKelamin, $santriTempatTglLahir, $santriAlamat, $santriNamaOrtu, $santriNoTelpOrtu, $santriGajiOrtu, $idKelas)
    {
        $stmt = $this->mysqli->prepare("INSERT INTO santris (username, password, roleId, santriJenisKelamin, santriTempatTglLahir, santriAlamat, santriNamaOrtu, santriNoTelpOrtu, santriGajiOrtu, idKelas) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssissssssi", $username, $password, $roleId, $santriJenisKelamin, $santriTempatTglLahir, $santriAlamat, $santriNamaOrtu, $santriNoTelpOrtu, $santriGajiOrtu, $idKelas);
        $stmt->execute();
        $stmt->close();
    }


    public function getAllSantri()
    {
        $result = $this->mysqli->query("SELECT * FROM santris");
        $santris = [];

        while ($row = $result->fetch_assoc()) {
            $role = $this->roleModel->getRoleById(3);
            $kelas = $this->kelasModel->getKelasById($row['idKelas']);
            $santris[] = [
                'id' => $row['id'],
                'username' => $row['username'],
                'password' => $row['password'],
                'roleId' => $role,
                'santriJenisKelamin' => $row['santriJenisKelamin'],
                'santriTempatTglLahir' => $row['santriTempatTglLahir'],
                'santriAlamat' => $row['santriAlamat'],
                'santriNamaOrtu' => $row['santriNamaOrtu'],
                'santriNoTelpOrtu' => $row['santriNoTelpOrtu'],
                'santriGajiOrtu' => $row['santriGajiOrtu'],
                'idKelas' => $kelas

            ];
        }

        return $santris;
    }

    public function getSantriById($id)
    {
        $stmt = $this->mysqli->prepare("SELECT * FROM santris WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $santri = $result->fetch_assoc();
        $stmt->close();

        if ($santri) {
            $role = $this->roleModel->getRoleById(3);
            $kelas = $this->kelasModel->getKelasById($santri['idKelas']);

            return [
                'id' => $santri['id'],
                'username' => $santri['username'],
                'password' => $santri['password'],
                'roleId' => $role,
                'santriJenisKelamin' => $santri['santriJenisKelamin'],
                'santriTempatTglLahir' => $santri['santriTempatTglLahir'],
                'santriAlamat' => $santri['santriAlamat'],
                'santriNamaOrtu' => $santri['santriNamaOrtu'],
                'santriNoTelpOrtu' => $santri['santriNoTelpOrtu'],
                'santriGajiOrtu' => $santri['santriGajiOrtu'],
                'idKelas' => $kelas
            ];
        }

        return null;
    }

    public function getSantriByKelasId($kelasId)
    {
        $stmt = $this->mysqli->prepare("SELECT * FROM santris WHERE idKelas = ?");
        $stmt->bind_param("i", $kelasId);
        $stmt->execute();
        $result = $stmt->get_result();

        $santris = [];
        while ($santri = $result->fetch_assoc()) {
            $role = $this->roleModel->getRoleById(3);
            $kelas = $this->kelasModel->getKelasById($santri['idKelas']);

            $santris[] = [
                'id' => $santri['id'],
                'username' => $santri['username'],
                'password' => $santri['password'],
                'roleId' => $role,
                'santriJenisKelamin' => $santri['santriJenisKelamin'],
                'santriTempatTglLahir' => $santri['santriTempatTglLahir'],
                'santriAlamat' => $santri['santriAlamat'],
                'santriNamaOrtu' => $santri['santriNamaOrtu'],
                'santriNoTelpOrtu' => $santri['santriNoTelpOrtu'],
                'santriGajiOrtu' => $santri['santriGajiOrtu'],
                'idKelas' => $kelas
            ];
        }
        $stmt->close();

        return $santris;
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

    public function updateSantri($id, $username, $password, $santriJenisKelamin, $santriTempatTglLahir, $santriAlamat, $santriNamaOrtu, $santriNoTelpOrtu, $santriGajiOrtu, $idKelas)
    {
        $stmt = $this->mysqli->prepare("UPDATE santris SET username = ?, password = ?, santriJenisKelamin = ?, santriTempatTglLahir = ?, santriAlamat = ?, santriNamaOrtu = ?, santriNoTelpOrtu = ?, santriGajiOrtu = ?, idKelas = ? WHERE id = ?");
        $stmt->bind_param("sssssssiis", $username, $password, $santriJenisKelamin, $santriTempatTglLahir, $santriAlamat, $santriNamaOrtu, $santriNoTelpOrtu, $santriGajiOrtu, $idKelas, $id);
        $stmt->execute();
        $stmt->close();
    }


    public function deleteSantri($id)
    {
        $stmt = $this->mysqli->prepare("DELETE FROM santris WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }

    public function getSantriByKelas($idKelas)
    {
        $stmt = $this->mysqli->prepare("SELECT * FROM santris WHERE idKelas = ?");
        $stmt->bind_param("i", $idKelas);
        $stmt->execute();
        $result = $stmt->get_result();
        $santris = [];
    }
}
