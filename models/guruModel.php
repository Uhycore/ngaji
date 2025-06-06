<?php
require_once 'database/koneksi.php';

require_once 'roleModel.php';

class GuruModel
{
    private $mysqli;
    private $roleModel;

    public function __construct($mysqli)
    {
        $this->mysqli = $mysqli;

      

        $this->roleModel = new RoleModel($mysqli);

        // Inisialisasi data default jika tabel kosong
        $result = $this->mysqli->query("SELECT COUNT(*) FROM gurus");
        $count = $result->fetch_row()[0];

        if ($count == 0) {
            $this->initializeDefaultGuru();
        }
    }

    public function initializeDefaultGuru()
    {
        $this->addGuru('Arilguru', '1', 2, 'Laki-laki', 'Jakarta/1 Jan 1990',  'Jl. Raya Jakarta', '0123456789');
        $this->addGuru('Mubinguru', '1', 2, 'Laki-laki', 'Jakarta/1 Jan 1990', 'Jl. Raya Jakarta', '0123456789');
    }

    public function addGuru($username, $password, $roleId, $guruJenisKelamin, $guruTempatTglLahir, $guruAlamat, $guruNoTelp)
    {
        $stmt = $this->mysqli->prepare("INSERT INTO gurus (username, password, roleId, guruJenisKelamin, guruTempatTglLahir, guruAlamat, guruNoTelp) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssisssi", $username, $password, $roleId, $guruJenisKelamin, $guruTempatTglLahir, $guruAlamat, $guruNoTelp);
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
                'id' => $row['id'],
                'username' => $row['username'],
                'password' => $row['password'],
                'roleId' => $role,
                'guruJenisKelamin' => $row['guruJenisKelamin'],
                'guruTempatTglLahir' => $row['guruTempatTglLahir'],
                'guruAlamat' => $row['guruAlamat'],
                'guruNoTelp' => $row['guruNoTelp']
            ];
        }

        return $gurus;
    }

    public function getGuruById($id)
    {
        $stmt = $this->mysqli->prepare("SELECT * FROM gurus WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();

        if ($row) {
            $role = $this->roleModel->getRoleById(2);  // Mendapatkan role dengan ID 2 (Guru)
            return [
                'id' => $row['id'],
                'username' => $row['username'],
                'password' => $row['password'],
                'roleId' => $role,
                'guruJenisKelamin' => $row['guruJenisKelamin'],
                'guruTempatTglLahir' => $row['guruTempatTglLahir'],

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

    public function updateGuru($id, $username, $password, $roleId, $guruJenisKelamin, $guruTempatTglLahir, $guruAlamat, $guruNoTelp)
    {
        // Memperbarui query tanpa idKelas
        $stmt = $this->mysqli->prepare("UPDATE gurus SET username = ?, password = ?, roleId = ?, guruJenisKelamin = ?, guruTempatTglLahir = ?, guruAlamat = ?, guruNoTelp = ? WHERE id = ?");

        // Binding parameter dengan jumlah yang sesuai
        $stmt->bind_param("ssisssii", $username, $password, $roleId, $guruJenisKelamin, $guruTempatTglLahir, $guruAlamat, $guruNoTelp, $id);

        // Eksekusi query
        $stmt->execute();

        // Menutup statement setelah eksekusi
        $stmt->close();
    }



    public function deleteGuru($id)
    {
        $stmt = $this->mysqli->prepare("DELETE FROM gurus WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }
}
