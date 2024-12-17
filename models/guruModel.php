<?php
require_once 'roleModel.php';

class GuruModel
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

        // Inisialisasi data default jika tabel kosong
        $result = $this->mysqli->query("SELECT COUNT(*) FROM gurus");
        $count = $result->fetch_row()[0];

        if ($count == 0) {
            $this->initializeDefaultGuru();
        }
    }

    public function initializeDefaultGuru()
    {
        $this->addGuru('Arilguru', '1', 2, 'Laki-laki', 'Jakarta/1 Jan 1990', 'Kelas 1', 'Jl. Raya Jakarta', '0123456789');
        $this->addGuru('Mubinguru', '1', 2, 'Laki-laki', 'Jakarta/1 Jan 1990', 'Kelas 2', 'Jl. Raya Jakarta', '0123456789');
    }

    public function addGuru($username, $password, $roleId, $guruJenisKelamin, $guruTempatTglLahir, $guruKelas, $guruAlamat, $guruNoTelp)
    {
        $stmt = $this->mysqli->prepare("INSERT INTO gurus (username, password, roleId, guruJenisKelamin, guruTempatTglLahir, guruKelas, guruAlamat, guruNoTelp) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssisssss", $username, $password, $roleId, $guruJenisKelamin, $guruTempatTglLahir, $guruKelas, $guruAlamat, $guruNoTelp);
        $stmt->execute();
        $stmt->close();
    }

    public function getAllGurus()
    {
        $result = $this->mysqli->query("SELECT * FROM gurus");
        $gurus = [];

        while ($row = $result->fetch_assoc()) {
            $role = $this->roleModel->getRoleById(2);  // Mendapatkan role dengan ID 2 (Guru)
            $gurus[] = [
                'guruId' => $row['guruId'],
                'username' => $row['username'],
                'password' => $row['password'],
                'roleId' => $role,
                'guruJenisKelamin' => $row['guruJenisKelamin'],
                'guruTempatTglLahir' => $row['guruTempatTglLahir'],
                'guruKelas' => $row['guruKelas'],
                'guruAlamat' => $row['guruAlamat'],
                'guruNoTelp' => $row['guruNoTelp']
            ];
        }

        return $gurus;
    }

    public function getGuruById($guruId)
    {
        $stmt = $this->mysqli->prepare("SELECT * FROM gurus WHERE guruId = ?");
        $stmt->bind_param("i", $guruId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();

        if ($row) {
            $role = $this->roleModel->getRoleById(2);  // Mendapatkan role dengan ID 2 (Guru)
            return [
                'guruId' => $row['guruId'],
                'username' => $row['username'],
                'password' => $row['password'],
                'roleId' => $role,
                'guruJenisKelamin' => $row['guruJenisKelamin'],
                'guruTempatTglLahir' => $row['guruTempatTglLahir'],
                'guruKelas' => $row['guruKelas'],
                'guruAlamat' => $row['guruAlamat'],
                'guruNoTelp' => $row['guruNoTelp']
            ];
        }

        return null;
    }

    public function getGuruByUsername($username)
    {
        $stmt = $this->mysqli->prepare("SELECT * FROM gurus WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $guru = $result->fetch_assoc();
        $stmt->close();

        return $guru;
    }

    public function updateGuru($guruId, $username, $password, $guruJenisKelamin, $guruTempatTglLahir, $guruKelas, $guruAlamat, $guruNoTelp)
    {
        $stmt = $this->mysqli->prepare("UPDATE gurus SET username = ?, password = ?, guruJenisKelamin = ?, guruTempatTglLahir = ?, guruKelas = ?, guruAlamat = ?, guruNoTelp = ? WHERE guruId = ?");
        $stmt->bind_param("sssssssi", $username, $password, $guruJenisKelamin, $guruTempatTglLahir, $guruKelas, $guruAlamat, $guruNoTelp, $guruId);
        $stmt->execute();
        $stmt->close();
    }

    public function deleteGuru($guruId)
    {
        $stmt = $this->mysqli->prepare("DELETE FROM gurus WHERE guruId = ?");
        $stmt->bind_param("i", $guruId);
        $stmt->execute();
        $stmt->close();
    }
}
