<?php
require_once 'config/detailKeuanganNode.php';
require_once 'config/keuanganNode.php';
require_once 'santriModel.php';

class KeuanganModel
{
    private $keuanganNodes = [];
    private $nextId = 1;

    public function __construct()
    {
        $this->loadFromJson();
    }

    public function addKeuangan($santriId, $detailKeuanganData)
    {
        $dataSantri = new SantriModel();
        $santri = $dataSantri->getSantriById($santriId);
        $keuanganNode = new KeuanganNode($this->nextId++, $santri);

        foreach ($detailKeuanganData as $detail) {
            $detailKeuangan = new DetailKeuanganNode($detail->detailKeuanganId, $detail->tanggal, $detail->nominal);
            $keuanganNode->detailKeuangan[] = $detailKeuangan;
        }

        $this->keuanganNodes[] = $keuanganNode;

        $this->saveToJson();
    }

    private function saveToJson()
    {
        $jsonData = json_encode($this->keuanganNodes, JSON_PRETTY_PRINT);
        file_put_contents('data/keuanganData.json', $jsonData);
    }

    private function loadFromJson()
    {
        $filePath = 'data/keuanganData.json';

        if (file_exists($filePath)) {
            $jsonData = file_get_contents($filePath);
            $dataArray = json_decode($jsonData, true);

            if ($dataArray) {
                $dataSantri = new SantriModel();

                foreach ($dataArray as $data) {
                    $santri = $dataSantri->getSantriById($data['santri']['santriId']);
                    $keuanganNode = new KeuanganNode($data['keuanganId'], $santri);

                    foreach ($data['detailKeuangan'] as $detail) {
                        $detailKeuangan = new DetailKeuanganNode(
                            $detail['detailKeuanganId'],
                            $detail['tanggal'],
                            $detail['nominal']
                        );
                        $keuanganNode->detailKeuangan[] = $detailKeuangan;
                    }

                    $this->keuanganNodes[] = $keuanganNode;
                }
                $this->nextId = $this->getMaxKeuanganId() + 1;
            }
        }
    }

    public function getAllKeuangan()
    {
        return $this->keuanganNodes;
    }

    public function getKeuanganById($keuanganId)
    {
        foreach ($this->keuanganNodes as $keuanganNode) {
            if ($keuanganNode->santri->santriId == $keuanganId) {
                return $keuanganNode;
            }
        }
        return null;
    }

    private function getMaxKeuanganId()
    {
        $maxId = 0;
        foreach ($this->keuanganNodes as $keuanganNode) {
            if ($keuanganNode->keuanganId > $maxId) {
                $maxId = $keuanganNode->keuanganId;
            }
        }
        return $maxId;
    }
}
