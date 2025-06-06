<?php
require_once 'database/koneksi.php';

require_once 'roleModel.php';

class BendaharaModel
{
    private $mysqli;
    private $roleModel;

    public function __construct($mysqli)
    {
        $this->mysqli = $mysqli;

        

        $this->roleModel = new RoleModel($mysqli);

        $result = $this->mysqli->query("SELECT COUNT(*) FROM bendaharas");
        $count = $result->fetch_row()[0];

        if ($count == 0) {
            $this->initializeDefaultBendahara();
        }
    }

    public function initializeDefaultBendahara()
    {
        $this->addBendahara('Arilbendahara', '1', 4, 'Laki-laki', 'Jakarta/1 Jan 1990', 'Kelas 1', 'Jl. Raya Jakarta', '0123456789');
        $this->addBendahara('Mubinbendahara', '1', 4, 'Laki-laki', 'Jakarta/1 Jan 1990', 'Kelas 2', 'Jl. Raya Jakarta', '0123456789');
    }

    public function addBendahara($username, $password, $roleId, $bendaharaJenisKelamin, $bendaharaTempatTglLahir, $bendaharaKelas, $bendaharaAlamat, $bendaharaNoTelp)
    {
        $stmt = $this->mysqli->prepare("INSERT INTO bendaharas (username, password, roleId, bendaharaJenisKelamin, bendaharaTempatTglLahir, bendaharaKelas, bendaharaAlamat, bendaharaNoTelp) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssisssss", $username, $password, $roleId, $bendaharaJenisKelamin, $bendaharaTempatTglLahir, $bendaharaKelas, $bendaharaAlamat, $bendaharaNoTelp);
        $stmt->execute();
        $stmt->close();
    }

    public function getAllBendaharas()
    {
        $result = $this->mysqli->query("SELECT * FROM bendaharas");
        $bendaharas = [];

        while ($row = $result->fetch_assoc()) {
            $role = $this->roleModel->getRoleById(4);
            $bendaharas[] = [
                'bendaharaId' => $row['bendaharaId'],
                'username' => $row['username'],
                'password' => $row['password'],
                'roleId' => $role,
                'bendaharaJenisKelamin' => $row['bendaharaJenisKelamin'],
                'bendaharaTempatTglLahir' => $row['bendaharaTempatTglLahir'],
                'bendaharaKelas' => $row['bendaharaKelas'],
                'bendaharaAlamat' => $row['bendaharaAlamat'],
                'bendaharaNoTelp' => $row['bendaharaNoTelp']
            ];
        }

        return $bendaharas;
    }

    public function getBendaharaById($bendaharaId)
    {
        $stmt = $this->mysqli->prepare("SELECT * FROM bendaharas WHERE bendaharaId = ?");
        $stmt->bind_param("i", $bendaharaId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();

        if ($row) {
            $role = $this->roleModel->getRoleById(4);
            return [
                'bendaharaId' => $row['bendaharaId'],
                'username' => $row['username'],
                'password' => $row['password'],
                'roleId' => $role,
                'bendaharaJenisKelamin' => $row['bendaharaJenisKelamin'],
                'bendaharaTempatTglLahir' => $row['bendaharaTempatTglLahir'],
                'bendaharaKelas' => $row['bendaharaKelas'],
                'bendaharaAlamat' => $row['bendaharaAlamat'],
                'bendaharaNoTelp' => $row['bendaharaNoTelp']
            ];
        }

        return null;
    }

    public function getBendaharaByUsername($username)
    {
        $stmt = $this->mysqli->prepare("SELECT * FROM bendaharas WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $bendahara = $result->fetch_assoc();
        $stmt->close();

        return $bendahara;
    }

    public function updateBendahara($bendaharaId, $username, $password, $bendaharaJenisKelamin, $bendaharaTempatTglLahir, $bendaharaKelas, $bendaharaAlamat, $bendaharaNoTelp)
    {
        $stmt = $this->mysqli->prepare("UPDATE bendaharas SET username = ?, password = ?, bendaharaJenisKelamin = ?, bendaharaTempatTglLahir = ?, bendaharaKelas = ?, bendaharaAlamat = ?, bendaharaNoTelp = ? WHERE bendaharaId = ?");
        $stmt->bind_param("sssssssi", $username, $password, $bendaharaJenisKelamin, $bendaharaTempatTglLahir, $bendaharaKelas, $bendaharaAlamat, $bendaharaNoTelp, $bendaharaId);
        $stmt->execute();
        $stmt->close();
    }

    public function deleteBendahara($bendaharaId)
    {
        $stmt = $this->mysqli->prepare("DELETE FROM bendaharas WHERE bendaharaId = ?");
        $stmt->bind_param("i", $bendaharaId);
        $stmt->execute();
        $stmt->close();
    }
}
