<?php
require_once 'database/koneksi.php';

require_once 'config/absenNode.php';
require_once 'models/santriModel.php';

class AbsenModel
{
    private $mysqli;
    private $santriModel;

    public function __construct($mysqli)
    {
        $this->mysqli = $mysqli;

        

        $this->santriModel = new SantriModel($mysqli);

        // Inisialisasi data default jika tabel kosong
        $result = $this->mysqli->query("SELECT COUNT(*) FROM absen");
        $count = $result->fetch_row()[0];

        if ($count == 0) {
            $this->initializeDefaultAbsen();
        }
    }

    public function initializeDefaultAbsen()
    {
        $this->addAbsen(1, '2024-12-21');
        $this->addAbsen(2, '2024-12-21');
        $this->addAbsen(3, '2024-12-21');
    }

    public function addAbsen($idSantri, $tanggal)
    {
        $stmt = $this->mysqli->prepare("INSERT INTO absen (idSantri, tanggal) VALUES (?, ?)");
        $stmt->bind_param("is", $idSantri, $tanggal);
        $stmt->execute();
        $stmt->close();
    }

    public function getAllAbsen()
    {
        $result = $this->mysqli->query("SELECT * FROM absen");
        $absenList = [];

        while ($row = $result->fetch_assoc()) {
            $santri = $this->santriModel->getSantriById($row['idSantri']);
            $absenNode = new Absen(
                $row['id'],
                $santri,
                $row['tanggal']
            );
            $absenList[] = $absenNode;
        }

        return $absenList;
    }

    public function getAbsenById($id)
    {
        $stmt = $this->mysqli->prepare("SELECT * FROM absen WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();

        if ($row) {
            $santri = $this->santriModel->getSantriById($row['idSantri']);
            return new Absen(
                $row['id'],
                $santri,
                $row['tanggal']
            );
        }

        return null;
    }
    public function getAbsenBySantriId($id)
    {
        $stmt = $this->mysqli->prepare("SELECT * FROM absen WHERE idSantri = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        $absens = [];
        while ($row = $result->fetch_assoc()) {
            $santri = $this->santriModel->getSantriById($row['idSantri']);
            $absens[] = new Absen(
                $row['id'],
                $santri,
                $row['tanggal']
            );
        }

        return $absens;
    }


    public function updateAbsen($id, $idSantri, $tanggal)
    {
        $stmt = $this->mysqli->prepare("UPDATE absen SET idSantri = ?, tanggal = ?  WHERE id = ?");
        $stmt->bind_param("isi", $idSantri, $tanggal, $id);
        $stmt->execute();
        $stmt->close();
    }

    public function deleteAbsen($id)
    {
        $stmt = $this->mysqli->prepare("DELETE FROM absen WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }
}
