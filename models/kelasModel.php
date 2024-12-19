<?php
require_once 'guruModel.php';

class KelasModel
{
    private $mysqli;
    private $guruModel;

    public function __construct()
    {
        $this->mysqli = new mysqli('localhost', 'root', '', 'tpq');

        if ($this->mysqli->connect_error) {
            die("Connection failed: " . $this->mysqli->connect_error);
        }

        $this->guruModel = new GuruModel();

        $result = $this->mysqli->query("SELECT COUNT(*) FROM kelas");
        $count = $result->fetch_row()[0];

        if ($count == 0) {
            $this->initializeDefaultKelas();
        }
    }

    public function initializeDefaultKelas()
    {
        $this->addKelas('Kelas 1', 1);
        $this->addKelas('Kelas 2', 2);
        $this->addKelas('Kelas 3', 3);
    }

    public function addKelas($namaKelas, $guruId)
    {
        $stmt = $this->mysqli->prepare("SELECT COUNT(*) FROM kelas WHERE namaKelas = ?");
        $stmt->bind_param("s", $namaKelas);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();

        if ($count > 0) {
            return false;
        }

        $stmt = $this->mysqli->prepare("INSERT INTO kelas (namaKelas, guruId) VALUES (?, ?)");
        $stmt->bind_param("si", $namaKelas, $guruId);
        $stmt->execute();
        $stmt->close();

        return true;
    }


    public function getAllKelas()
    {
        $result = $this->mysqli->query("SELECT * FROM kelas");
        $KelasList = [];

        while ($row = $result->fetch_assoc()) {
            $guru = $this->guruModel->getGuruById($row['guruId']);
            $KelasList[] = [
                'id' => $row['id'],
                'namaKelas' => $row['namaKelas'],
                'guruId' => $guru
            ];
        }

        return $KelasList;
    }

    public function getKelasById($id)
    {
        $stmt = $this->mysqli->prepare("SELECT * FROM kelas WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();

        if ($row) {
            $guru = $this->guruModel->getGuruById($row['guruId']);
            return [
                'id' => $row['id'],
                'namaKelas' => $row['namaKelas'],
                'guruId' => $guru
            ];
        }

        return null;
    }



    public function updateKelas($id, $namaKelas, $guruId)
    {
        $stmt = $this->mysqli->prepare("UPDATE Kelas SET namaKelas = ?, guruId = ? WHERE id = ?");
        $stmt->bind_param("sii", $namaKelas, $guruId, $id);
        $stmt->execute();
        $stmt->close();
    }

    public function deleteKelas($id)
    {
        $stmt = $this->mysqli->prepare("DELETE FROM kelas WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }
}
