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
        // Koneksi ke database MySQL
        $this->mysqli = new mysqli('localhost', 'root', '', 'tpq');

        if ($this->mysqli->connect_error) {
            die("Connection failed: " . $this->mysqli->connect_error);
        }

        // Instansiasi kelasModel
        $this->kelasModel = new KelasModel();
    }

    // Menambahkan nilai untuk santri
    public function addNilai($santriId, $detailNilaiData)
    {
        // Mengecek apakah santri sudah memiliki nilai
        $stmt = $this->mysqli->prepare("SELECT nilaiId FROM nilai WHERE santriId = ?");
        $stmt->bind_param("i", $santriId);
        $stmt->execute();
        $stmt->store_result();

        // Jika sudah ada, update nilai
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($nilaiId);
            $stmt->fetch();
            $stmt->close();
            $this->updateNilai($nilaiId, $detailNilaiData);
        } else {
            // Jika belum ada, tambahkan nilai baru
            $stmt = $this->mysqli->prepare("INSERT INTO nilai (santriId) VALUES (?)");
            $stmt->bind_param("i", $santriId);
            if ($stmt->execute()) {
                $nilaiId = $stmt->insert_id;
                $stmt->close();

                // Menambahkan detail nilai
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

    // Update nilai berdasarkan nilaiId
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

    // Mendapatkan semua nilai untuk setiap santri
    public function getAllNilai()
    {
        $result = $this->mysqli->query("SELECT * FROM nilai");
        $nilaiNodes = [];

        while ($row = $result->fetch_assoc()) {
            $nilaiId = $row['id'];
            $santriId = $row['santriId'];

            // Mendapatkan detail nilai terkait
            $detailNilaiResult = $this->mysqli->query("SELECT dn.*, m.mapelNama FROM detail_nilai dn 
                                           JOIN mapels m ON m.id = dn.mapelId
                                           WHERE dn.nilaiId = $nilaiId");

            // Pastikan kelasModel sudah terinisialisasi
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

    // Mendapatkan nilai berdasarkan nilaiId
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
                                           JOIN mapels m ON m.id = dn.mapelId
                                           WHERE dn.nilaiId = $nilaiId");

            // Pastikan kelasModel sudah terinisialisasi
            if (!$this->kelasModel) {
                throw new Exception("KelasModel is not initialized.");
            }

            // Mendapatkan kelas dari kelasModel
            $kelas = $this->kelasModel->getKelasById($row['id']);
            $detailNilai = [];

            // Proses detail nilai untuk setiap mapel
            while ($detailRow = $detailNilaiResult->fetch_assoc()) {
                $mapel = new Mapel($detailRow['mapelId'], $detailRow['mapelNama'], null, $kelas);
                $detailNilai[] = new DetailNilaiNode($detailRow['id'], $mapel, $detailRow['nilai']);
            }

            // Buat objek NilaiNode dengan data santri dan detail nilai
            $nilaiNode = new NilaiNode($row['id'], $santri);
            $nilaiNode->detailNilai = $detailNilai;

            return $nilaiNode;
        }

        return null; // Jika tidak ditemukan
    }
    public function getNilaiBySantriId($nilaiId)
    {
        // Prepare statement to get the nilai based on nilaiId
        $stmt = $this->mysqli->prepare("SELECT * FROM nilai WHERE id = ?");
        $stmt->bind_param("i", $nilaiId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();

        if ($row) {
            // Get the santri ID and retrieve santri details
            $santriId = $row['santriId'];
            $santri = (new SantriModel())->getSantriById($santriId);

            // Ambil detail nilai yang terkait dengan nilaiId dan mapel
            $detailNilaiResult = $this->mysqli->prepare("SELECT dn.*, m.mapelNama FROM detail_nilai dn 
                                                     JOIN mapels m ON m.id = dn.mapelId
                                                     WHERE dn.nilaiId = ?");
            $detailNilaiResult->bind_param("i", $nilaiId);
            $detailNilaiResult->execute();
            $detailResult = $detailNilaiResult->get_result();

            // Pastikan kelasModel sudah terinisialisasi
            if (!$this->kelasModel) {
                throw new Exception("KelasModel is not initialized.");
            }

            // Mendapatkan kelas dari kelasModel berdasarkan ID yang tepat
            $kelas = $this->kelasModel->getKelasById($row['id']); // Pastikan menggunakan idKelas, bukan id

            $detailNilai = [];

            // Proses detail nilai untuk setiap mapel
            while ($detailRow = $detailResult->fetch_assoc()) {
                $mapel = new Mapel($detailRow['mapelId'], $detailRow['mapelNama'], null, $kelas);
                $detailNilai[] = new DetailNilaiNode($detailRow['id'], $mapel, $detailRow['nilai']);
            }

            // Buat objek NilaiNode dengan data santri dan detail nilai
            $nilaiNode = new NilaiNode($row['id'], $santri);
            $nilaiNode->detailNilai = $detailNilai;

            return $nilaiNode;
        }

        return null; // Jika tidak ditemukan
    }
}
