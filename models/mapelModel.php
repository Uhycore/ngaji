<?php
require_once 'config/mapelNode.php';

class MapelModel
{
    private $mapels = [];
    private $nextId = 1;
    private $jsonFilePath = 'data/mapels.json';

    public function __construct()
    {
        if (file_exists($this->jsonFilePath)) {
            $this->loadFromJsonFile();
            $this->nextId = $this->getMaxMapelId() + 1;
        } else {
            $this->initializeDefaultMapel();
            $this->saveToJsonFile();
        }
    }

    public function initializeDefaultMapel()
    {
        $this->addMapel('An-nas', 'Al-Qur\'an');
        $this->addMapel('Al-falaq', 'Al-Qur\'an');
        $this->addMapel('Al-ikhlas', 'Al-Qur\'an');
    }

    public function addMapel($mapelNama, $mapelDeskripsi)
    {
        $mapel = new Mapel($this->nextId++, $mapelNama, $mapelDeskripsi);
        $this->mapels[] = $mapel;
        $this->saveToJsonFile();
    }

    private function saveToJsonFile()
    {
        $mapelsArray = array_map(function ($mapel) {
            return [
                'mapelId' => $mapel->mapelId,
                'mapelNama' => $mapel->mapelNama,
                'mapelDeskripsi' => $mapel->mapelDeskripsi,
            ];
        }, $this->mapels);

        file_put_contents($this->jsonFilePath, json_encode($mapelsArray, JSON_PRETTY_PRINT));
    }

    private function loadFromJsonFile()
    {
        $data = json_decode(file_get_contents($this->jsonFilePath), true);
        if ($data) {
            $this->mapels = array_map(function ($item) {
                return new Mapel($item['mapelId'], $item['mapelNama'], $item['mapelDeskripsi']);
            }, $data);
        }
    }

    public function getAllmapel()
    {
        return $this->mapels;
    }

    public function getMapelById($mapelId)
    {
        foreach ($this->mapels as $mapel) {
            if ($mapel->mapelId == $mapelId) {
                return $mapel;
            }
        }
        return null;
    }

    public function updateMapel($mapelId, $mapelNama, $mapelDeskripsi)
    {
        foreach ($this->mapels as $mapel) {
            if ($mapel->mapelId == $mapelId) {
                $mapel->mapelNama = $mapelNama;
                $mapel->mapelDeskripsi = $mapelDeskripsi;
                $this->saveToJsonFile();
                return true;
            }
        }
        return false;
    }

    public function deleteMapel($mapelId)
    {
        foreach ($this->mapels as $key => $mapel) {
            if ($mapel->mapelId == $mapelId) {
                unset($this->mapels[$key]);
                $this->mapels = array_values($this->mapels);
                $this->saveToJsonFile();
                return true;
            }
        }
        return false;
    }

    public function getMapelByNama($mapelNama)
    {
        foreach ($this->mapels as $mapel) {
            if ($mapel->mapelNama == $mapelNama) {
                return $mapel;
            }
        }
        return null;
    }

    private function getMaxMapelId()
    {
        $maxId = 0;
        foreach ($this->mapels as $mapel) {
            if ($mapel->mapelId > $maxId) {
                $maxId = $mapel->mapelId;
            }
        }
        return $maxId;
    }
}
