<?php
require_once 'config/detailNilaiNode.php';
require_once 'config/nilaiNode.php';
require_once 'santriModel.php';
require_once 'kelasModel.php';

class NilaiModel
{
    private $mysqli;
    private $kelasModel;

    public function __construct()
    {
        $this->mysqli = new mysqli('localhost', 'root', '', 'tpq');

        if ($this->mysqli->connect_error) {
            die("Connection failed: " . $this->mysqli->connect_error);
        }

        $this->kelasModel = new KelasModel();
    }


    public function addNilai($santriId, $detailNilaiData)
    {
        $stmt = $this->mysqli->prepare("SELECT id FROM nilai WHERE santriId = ?");
        $stmt->bind_param("i", $santriId);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($nilaiId);
            $stmt->fetch();
            $stmt->close();

            foreach ($detailNilaiData as $detail) {
                $mapelId = $detail->mapel->mapelId;
                $nilai = $detail->nilai;

                $stmt = $this->mysqli->prepare("SELECT id FROM detail_nilai WHERE nilaiId = ? AND mapelId = ?");
                $stmt->bind_param("ii", $nilaiId, $mapelId);
                $stmt->execute();
                $stmt->store_result();

                if ($stmt->num_rows > 0) {

                    $stmt->bind_result($detailId);
                    $stmt->fetch();
                    $stmt->close();

                    $stmt = $this->mysqli->prepare("UPDATE detail_nilai SET nilai = ? WHERE id = ?");
                    $stmt->bind_param("ii", $nilai, $detailId);
                    $stmt->execute();
                    $stmt->close();
                } else {
                    $stmt = $this->mysqli->prepare("INSERT INTO detail_nilai (nilaiId, mapelId, nilai) VALUES (?, ?, ?)");
                    $stmt->bind_param("iii", $nilaiId, $mapelId, $nilai);
                    $stmt->execute();
                    $stmt->close();
                }
            }
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

        foreach ($detailNilaiData as $detail) {
            $mapelId = $detail->mapel->mapelId;
            $nilai = $detail->nilai;

            $stmt = $this->mysqli->prepare("UPDATE detail_nilai SET nilai = ? WHERE nilaiId = ? AND mapelId = ?");
            $stmt->bind_param("iii", $nilai, $nilaiId, $mapelId);
            $stmt->execute();
            $stmt->close();
        }
    }

    public function getAllNilai()
    {
        $result = $this->mysqli->query("SELECT * FROM nilai");
        $nilaiNodes = [];

        while ($row = $result->fetch_assoc()) {
            $nilaiId = $row['id'];
            $santriId = $row['santriId'];

            $detailNilaiResult = $this->mysqli->query("SELECT dn.*, m.mapelNama FROM detail_nilai dn 
                                           JOIN mapels m ON m.id = dn.mapelId
                                           WHERE dn.nilaiId = $nilaiId");

            if (!$this->kelasModel) {
                throw new Exception("KelasModel is not initialized.");
            }

            $kelas = $this->kelasModel->getKelasById($row['id']);
            $detailNilai = [];
            while ($detailRow = $detailNilaiResult->fetch_assoc()) {
                $mapel = new Mapel($detailRow['mapelId'], $detailRow['mapelNama'], null, $kelas);
                $detailNilai[] = new DetailNilaiNode($detailRow['id'], $mapel, $detailRow['nilai']);
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

            $detailNilaiResult = $this->mysqli->query("SELECT dn.*, m.mapelNama FROM detail_nilai dn 
                                           JOIN mapels m ON m.id = dn.mapelId
                                           WHERE dn.nilaiId = $nilaiId");

            if (!$this->kelasModel) {
                throw new Exception("KelasModel is not initialized.");
            }

            $kelas = $this->kelasModel->getKelasById($row['id']);
            $detailNilai = [];

            while ($detailRow = $detailNilaiResult->fetch_assoc()) {
                $mapel = new Mapel($detailRow['mapelId'], $detailRow['mapelNama'], null, $kelas);
                $detailNilai[] = new DetailNilaiNode($detailRow['id'], $mapel, $detailRow['nilai']);
            }

            $nilaiNode = new NilaiNode($row['id'], $santri);
            $nilaiNode->detailNilai = $detailNilai;

            return $nilaiNode;
        }

        return null;
    }
    public function getNilaiBySantriId($santriId)
    {
        $stmt = $this->mysqli->prepare("SELECT * FROM nilai WHERE santriId = ?");
        $stmt->bind_param("i", $santriId);
        $stmt->execute();
        $result = $stmt->get_result();

        $nilaiNodes = [];

        while ($row = $result->fetch_assoc()) {
            $nilaiId = $row['id'];

            $detailNilaiStmt = $this->mysqli->prepare("SELECT dn.*, m.mapelNama 
                                                   FROM detail_nilai dn
                                                   JOIN mapels m ON m.id = dn.mapelId
                                                   WHERE dn.nilaiId = ?");
            $detailNilaiStmt->bind_param("i", $nilaiId);
            $detailNilaiStmt->execute();
            $detailResult = $detailNilaiStmt->get_result();

            if (!$this->kelasModel) {
                throw new Exception("KelasModel is not initialized.");
            }

            $detailNilai = [];
            while ($detailRow = $detailResult->fetch_assoc()) {

                $mapel = new Mapel($detailRow['mapelId'], $detailRow['mapelNama'], null, null);
                $detailNilai[] = new DetailNilaiNode($detailRow['id'], $mapel, $detailRow['nilai']);
            }

            $detailNilaiStmt->close();

            $santri = (new SantriModel())->getSantriById($santriId);

            $nilaiNode = new NilaiNode($row['id'], $santri);
            $nilaiNode->detailNilai = $detailNilai;

            $nilaiNodes[] = $nilaiNode;
        }

        $stmt->close();

        return $nilaiNodes;
    }
}
