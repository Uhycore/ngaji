<?php
require_once 'database/koneksi.php';

require_once 'kelasModel.php';
require_once 'config/mapelNode.php';
class MapelModel
{
    private $mysqli;
    private $kelasModel;

    public function __construct($mysqli)
    {
        $this->mysqli = $mysqli;

        
        $this->kelasModel = new KelasModel($mysqli);

        $result = $this->mysqli->query("SELECT COUNT(*) FROM mapels");
        $count = $result->fetch_row()[0];

        if ($count == 0) {
            $this->initializeDefaultMapel();
        }
    }

    public function initializeDefaultMapel()
    {
        $this->addMapel('turutan', 'Turutan', 1);
        $this->addMapel('iqra', 'Iqra', 2);
        $this->addMapel('jus-Amma', 'Jus Amma', 3);
        $this->addMapel('Al-Quran', 'Al-Quran', 4);
        $this->addMapel('Tajwid', 'Tajwid', 5);
        $this->addMapel('Al-Fiqh', 'Al-Fiqh', 6);
        $this->addMapel('Sejarah', 'Sejarah', 7);
    }

    public function addMapel($mapelNama, $mapelDeskripsi, $kelasId)
    {
        $stmt = $this->mysqli->prepare("INSERT INTO mapels (mapelNama, mapelDeskripsi, kelasId) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $mapelNama, $mapelDeskripsi, $kelasId);
        $stmt->execute();
        $stmt->close();
    }

    public function getAllMapel()
    {
        $result = $this->mysqli->query("SELECT * FROM mapels");
        $mapels = [];

        while ($row = $result->fetch_assoc()) {
            $kelas = $this->kelasModel->getKelasById($row['kelasId']);

            $mapels[] = new Mapel(
                $row['id'],
                $row['mapelNama'],
                $row['mapelDeskripsi'],
                $kelas
            );
        }

        return $mapels;
    }

    public function getMapelById($id)
    {
        $stmt = $this->mysqli->prepare("SELECT * FROM mapels WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $mapel = $result->fetch_assoc();
        $stmt->close();

        if ($mapel) {
            $kelas = $this->kelasModel->getKelasById($mapel['kelasId']);

            return new Mapel(
                $mapel['id'],
                $mapel['mapelNama'],
                $mapel['mapelDeskripsi'],
                $kelas
            );
        }

        return null;
    }

    public function updateMapel($id, $mapelNama, $mapelDeskripsi, $kelasId)
    {
        $stmt = $this->mysqli->prepare("UPDATE mapels SET mapelNama = ?, mapelDeskripsi = ?, kelasId = ? WHERE id = ?");
        $stmt->bind_param("ssii", $mapelNama, $mapelDeskripsi, $kelasId, $id);
        $stmt->execute();
        $stmt->close();
    }

    public function deleteMapel($id)
    {
        $stmt = $this->mysqli->prepare("DELETE FROM detail_nilai WHERE mapelId = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();

        $stmt = $this->mysqli->prepare("DELETE FROM mapels WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }


    public function getMapelByNama($mapelNama)
    {
        $stmt = $this->mysqli->prepare("SELECT * FROM mapels WHERE mapelNama = ?");
        $stmt->bind_param("s", $mapelNama);
        $stmt->execute();
        $result = $stmt->get_result();
        $mapel = $result->fetch_assoc();
        $stmt->close();

        if ($mapel) {
            $kelas = $this->kelasModel->getKelasById($mapel['kelasId']);

            return new Mapel(
                $mapel['id'],
                $mapel['mapelNama'],
                $mapel['mapelDeskripsi'],
                $kelas
            );
        }

        return null;
    }
}
