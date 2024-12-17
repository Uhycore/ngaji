<?php
require_once 'config/detailKeuanganNode.php';
require_once 'config/keuanganNode.php';
require_once 'santriModel.php';

class KeuanganModel
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

    // Menambahkan data keuangan dan detail keuangan
    public function addKeuangan($santriId, $detailKeuanganData)
    {
        // Insert ke tabel keuangan
        $stmt = $this->mysqli->prepare("INSERT INTO keuangan (santriId) VALUES (?)");
        $stmt->bind_param("i", $santriId);
        if ($stmt->execute()) {
            $keuanganId = $stmt->insert_id; // Dapatkan ID keuangan baru
            $stmt->close();

            // Insert ke tabel detail_keuangan
            foreach ($detailKeuanganData as $detail) {
                $tanggal = $detail->tanggal;
                $nominal = $detail->nominal;

                $stmt = $this->mysqli->prepare("INSERT INTO detail_keuangan (keuanganId, tanggal, nominal) VALUES (?, ?, ?)");
                $stmt->bind_param("isd", $keuanganId, $tanggal, $nominal);
                $stmt->execute();
                $stmt->close();
            }
        } else {
            throw new Exception("Failed to add keuangan.");
        }
    }

    // Mendapatkan semua data keuangan
    public function getAllKeuangan()
    {
        $result = $this->mysqli->query("SELECT * FROM keuangan");
        $keuanganNodes = [];

        while ($row = $result->fetch_assoc()) {
            $keuanganId = $row['keuanganId'];
            $santriId = $row['santriId'];

            // Ambil detail keuangan
            $detailResult = $this->mysqli->query("SELECT * FROM detail_keuangan WHERE keuanganId = $keuanganId");
            $detailKeuangan = [];
            while ($detailRow = $detailResult->fetch_assoc()) {
                $detailKeuangan[] = new DetailKeuanganNode(
                    $detailRow['detailKeuanganId'],
                    $detailRow['tanggal'],
                    $detailRow['nominal']
                );
            }

            $santri = (new SantriModel())->getSantriById($santriId);
            $keuanganNode = new KeuanganNode($keuanganId, $santri);
            $keuanganNode->detailKeuangan = $detailKeuangan;

            $keuanganNodes[] = $keuanganNode;
        }

        return $keuanganNodes;
    }

    // Mendapatkan data keuangan berdasarkan ID
    public function getKeuanganById($keuanganId)
    {
        $stmt = $this->mysqli->prepare("SELECT * FROM keuangan WHERE keuanganId = ?");
        $stmt->bind_param("i", $keuanganId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();

        if ($row) {
            $santriId = $row['santriId'];
            $santri = (new SantriModel())->getSantriById($santriId);

            // Ambil detail keuangan
            $detailResult = $this->mysqli->query("SELECT * FROM detail_keuangan WHERE keuanganId = $keuanganId");
            $detailKeuangan = [];
            while ($detailRow = $detailResult->fetch_assoc()) {
                $detailKeuangan[] = new DetailKeuanganNode(
                    $detailRow['detailKeuanganId'],
                    $detailRow['tanggal'],
                    $detailRow['nominal']
                );
            }

            $keuanganNode = new KeuanganNode($keuanganId, $santri);
            $keuanganNode->detailKeuangan = $detailKeuangan;

            return $keuanganNode;
        }

        return null;
    }
}
