<?php
require_once 'config/mapelNode.php';

class MapelModel
{
    private $mysqli;

    public function __construct()
    {
        // Menghubungkan ke database MySQL
        $this->mysqli = new mysqli('localhost', 'root', '', 'tpq');

        if ($this->mysqli->connect_error) {
            die("Connection failed: " . $this->mysqli->connect_error);
        }

        // Mengecek apakah tabel mapels kosong dan menginisialisasi data default jika perlu
        $result = $this->mysqli->query("SELECT COUNT(*) FROM mapels");
        $count = $result->fetch_row()[0];

        if ($count == 0) {
            $this->initializeDefaultMapel();
        }
    }

    // Menambahkan mapel default jika tabel kosong
    public function initializeDefaultMapel()
    {
        $this->addMapel('turutan', 'Turutan');
        $this->addMapel('iqra', 'Iqra');
        $this->addMapel('jus-Amma', 'Jus Amma');
        $this->addMapel('Al-Quran', 'Al-Quran');
        $this->addMapel('Tajwid', 'Tajwid');
        $this->addMapel('Al-Fiqh', 'Al-Fiqh');
        $this->addMapel('Sejarah', 'Sejarah');

    }

    // Menambahkan mapel baru ke database
    public function addMapel($mapelNama, $mapelDeskripsi)
    {
        $stmt = $this->mysqli->prepare("INSERT INTO mapels (mapelNama, mapelDeskripsi) VALUES (?, ?)");
        $stmt->bind_param("ss", $mapelNama, $mapelDeskripsi);
        $stmt->execute();
        $stmt->close();
    }

    // Mendapatkan semua mapel
    public function getAllMapel()
    {
        $result = $this->mysqli->query("SELECT * FROM mapels");
        $mapels = [];

        while ($row = $result->fetch_assoc()) {
            $mapels[] = new Mapel(
                $row['mapelId'],
                $row['mapelNama'],
                $row['mapelDeskripsi']
            );
        }

        return $mapels;
    }

    // Mendapatkan mapel berdasarkan ID
    public function getMapelById($mapelId)
    {
        $stmt = $this->mysqli->prepare("SELECT * FROM mapels WHERE mapelId = ?");
        $stmt->bind_param("i", $mapelId);
        $stmt->execute();
        $result = $stmt->get_result();
        $mapel = $result->fetch_assoc();
        $stmt->close();

        if ($mapel) {
            return new Mapel(
                $mapel['mapelId'],
                $mapel['mapelNama'],
                $mapel['mapelDeskripsi']
            );
        }

        return null;
    }

    public function updateMapel($mapelId, $mapelNama, $mapelDeskripsi)
    {
        $stmt = $this->mysqli->prepare("UPDATE mapels SET mapelNama = ?, mapelDeskripsi = ? WHERE mapelId = ?");
        $stmt->bind_param("ssi", $mapelNama, $mapelDeskripsi, $mapelId);
        $stmt->execute();
        $stmt->close();
    }

    public function deleteMapel($mapelId)
    {
        $stmt = $this->mysqli->prepare("DELETE FROM detail_nilai WHERE mapelId = ?");
        $stmt->bind_param("i", $mapelId);
        $stmt->execute();
        $stmt->close();
        
        $stmt = $this->mysqli->prepare("DELETE FROM mapels WHERE mapelId = ?");
        $stmt->bind_param("i", $mapelId);
        $stmt->execute();
        $stmt->close();
    }


    // Mendapatkan mapel berdasarkan nama
    public function getMapelByNama($mapelNama)
    {
        $stmt = $this->mysqli->prepare("SELECT * FROM mapels WHERE mapelNama = ?");
        $stmt->bind_param("s", $mapelNama);
        $stmt->execute();
        $result = $stmt->get_result();
        $mapel = $result->fetch_assoc();
        $stmt->close();

        if ($mapel) {
            return new Mapel(
                $mapel['mapelId'],
                $mapel['mapelNama'],
                $mapel['mapelDeskripsi']
            );
        }

        return null;
    }
}
