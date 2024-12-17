<?php
require_once 'config/detailNilaiNode.php';
require_once 'config/nilaiNode.php';
require_once 'santriModel.php';

class NilaiModel
{
    private $mysqli;

    public function __construct()
    {
        // Koneksi ke database MySQL
        $this->mysqli = new mysqli('localhost', 'root', '', 'tpq');

        if ($this->mysqli->connect_error) {
            die("Connection failed: " . $this->mysqli->connect_error);
        }
    }

    // Menambahkan nilai untuk santri
    public function addNilai($santriId, $detailNilaiData)
    {
        $stmt = $this->mysqli->prepare("SELECT nilaiId FROM nilai WHERE santriId = ?");
        $stmt->bind_param("i", $santriId);
        $stmt->execute();
        $stmt->store_result();


        if ($stmt->num_rows > 0) {
            $stmt->bind_result($nilaiId);
            $stmt->fetch();
            $stmt->close();

            $this->updateNilai($nilaiId, $detailNilaiData);
        } else {
            $stmt = $this->mysqli->prepare("INSERT INTO nilai (santriId) VALUES (?)");
            $stmt->bind_param("i", $santriId);
            if ($stmt->execute()) {
                $nilaiId = $stmt->insert_id;
                $stmt->close();


                foreach ($detailNilaiData as $detail) {
                    $mapelId = $detail->mapel->mapelId;
                    $nilai = $detail->nilai;

                    $stmt = $this->mysqli->prepare("INSERT INTO detail_nilai (nilaiId, mapelId, nilai) VALUES (?, ?, ?)");
                    $stmt->bind_param("iii", $nilaiId, $mapelId, $nilai);
                    $stmt->execute();
                    $stmt->close();
                }
            } else {
                throw new Exception("Failed to add nilai.");
            }
        }
    }

    public function updateNilai($nilaiId, $detailNilaiData)
    {
        // Update detail nilai berdasarkan nilaiId
        foreach ($detailNilaiData as $detail) {
            $mapelId = $detail->mapel->mapelId;
            $nilai = $detail->nilai;

            $stmt = $this->mysqli->prepare("UPDATE detail_nilai SET nilai = ? WHERE nilaiId = ? AND mapelId = ?");
            $stmt->bind_param("iii", $nilai, $nilaiId, $mapelId);
            $stmt->execute();
            $stmt->close();
        }
    }


    // Mendapatkan semua nilai
    public function getAllNilai()
    {
        $result = $this->mysqli->query("SELECT * FROM nilai");
        $nilaiNodes = [];

        while ($row = $result->fetch_assoc()) {
            $nilaiId = $row['nilaiId'];
            $santriId = $row['santriId'];

            $detailNilaiResult = $this->mysqli->query("SELECT dn.*, m.mapelNama FROM detail_nilai dn 
                                                     JOIN mapels m ON m.mapelId = dn.mapelId
                                                     WHERE dn.nilaiId = $santriId");

            $detailNilai = [];
            while ($detailRow = $detailNilaiResult->fetch_assoc()) {
                $mapel = new Mapel($detailRow['mapelId'], $detailRow['mapelNama'], null);
                $detailNilai[] = new DetailNilaiNode($detailRow['detailNilaiId'], $mapel, $detailRow['nilai']);
            }

            $santri = (new SantriModel())->getSantriById($santriId);
            $nilaiNode = new NilaiNode($santriId, $santri);
            $nilaiNode->detailNilai = $detailNilai;

            $nilaiNodes[] = $nilaiNode;
        }

        return $nilaiNodes;
    }

    public function getNilaiById($nilaiId)
    {
        $stmt = $this->mysqli->prepare("SELECT * FROM nilai WHERE nilaiId = ?");
        $stmt->bind_param("i", $nilaiId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();

        if ($row) {
            $santriId = $row['santriId'];
            $santri = (new SantriModel())->getSantriById($santriId);

            // Ambil detail nilai terkait
            $detailNilaiResult = $this->mysqli->query("SELECT dn.*, m.mapelNama FROM detail_nilai dn
                                                      JOIN mapels m ON m.mapelId = dn.mapelId
                                                      WHERE dn.nilaiId = $nilaiId");

            $detailNilai = [];
            while ($detailRow = $detailNilaiResult->fetch_assoc()) {
                $mapel = new Mapel($detailRow['mapelId'], $detailRow['mapelNama'], null);
                $detailNilai[] = new DetailNilaiNode($detailRow['detailNilaiId'], $mapel, $detailRow['nilai']);
            }

            $nilaiNode = new NilaiNode($row['nilaiId'], $santri);
            $nilaiNode->detailNilai = $detailNilai;
            return $nilaiNode;
        }

        return null;
    }
    public function getNilaiBySantriId($santriId)
    {
        $santriId = (int)$santriId; // Pastikan format integer
        $stmt = $this->mysqli->prepare("SELECT * FROM nilai WHERE santriId = ?");
        $stmt->bind_param("i", $santriId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {

            return null;
        }

        $row = $result->fetch_assoc();
        $stmt->close();

        // Ambil detail nilai
        $nilaiId = $row['nilaiId'];
        
        $detailNilaiResult = $this->mysqli->query("SELECT dn.*, m.mapelNama FROM detail_nilai dn
                                              JOIN mapels m ON m.mapelId = dn.mapelId
                                              WHERE dn.nilaiId = $santriId");

        if ($detailNilaiResult->num_rows === 0) {

            return null;
        }

        $detailNilai = [];
        while ($detailRow = $detailNilaiResult->fetch_assoc()) {
            $mapel = new Mapel($detailRow['mapelId'], $detailRow['mapelNama'], null);
            $detailNilai[] = new DetailNilaiNode($detailRow['detailNilaiId'], $mapel, $detailRow['nilai']);
        }

        // Ambil informasi santri
        $santri = (new SantriModel())->getSantriById($santriId);

        // Buat node nilai
        $nilaiNode = new NilaiNode($row['nilaiId'], $santri);
        $nilaiNode->detailNilai = $detailNilai;
        return $nilaiNode;
    }
}
