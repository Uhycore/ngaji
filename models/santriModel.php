<?php
require_once 'config/santriNode.php';

class SantriModel 
{
    private $santris = [];
    private $nextIdSantri = 1;
    private $roleModel;
    private $jsonFilePath = 'data/santris.json';

    public function __construct()
    {
        $this->roleModel = new RoleModel();

        if (file_exists($this->jsonFilePath)) {
            $this->loadFromJsonFile();
            $this->nextIdSantri = $this->getMaxSantriId() + 1;
        } else {
            $this->initializeDefaultUser();
            $this->saveToJsonFile();
        }
    }

    public function initializeDefaultUser()
    {
        $this->addSantri('Arilsantri', '1', 3,  'Laki-laki', 'Jakarta', 'Jl. Raya Jakarta', 'Aril', '0123456789', '1000000');
        $this->addSantri('Mubin', '1', 3,  'Laki-laki', 'Jakarta', 'Jl. Raya Jakarta', 'Aril', '0123456789', '1000000');
        $this->addSantri('Asyraril', '1', 3, 'Laki-laki', 'Jakarta', 'Jl. Raya Jakarta', 'Aril', '0123456789', '1000000');
    }

    public function addSantri($username, $password, $role, $santriJenisKelamin, $santriTempatTglLahir, $santriAlamat, $santriNamaOrtu, $santriNoTelpOrtu, $santriGajiOrtu)
    {
        $role = $this->roleModel->getRoleById($role);
        $santri = new Santri(3, $username, $password, $role, $this->nextIdSantri++, $santriJenisKelamin, $santriTempatTglLahir, $santriAlamat, $santriNamaOrtu, $santriNoTelpOrtu, $santriGajiOrtu);
        $this->santris[] = $santri;
        $this->saveToJsonFile();
    }

    private function saveToJsonFile()
    {
        $santriData = array_map(function ($santri) {
            return [
                'userId' => $santri->userId,
                'username' => $santri->username,
                'password' => $santri->password,
                'role' => $santri->role,
                'santriId' => $santri->santriId,
                'santriJenisKelamin' => $santri->santriJenisKelamin,
                'santriTempatTglLahir' => $santri->santriTempatTglLahir,
                'santriAlamat' => $santri->santriAlamat,
                'santriNamaOrtu' => $santri->santriNamaOrtu,
                'santriNoTelpOrtu' => $santri->santriNoTelpOrtu,
                'santriGajiOrtu' => $santri->santriGajiOrtu,
            ];
        }, $this->santris);

        file_put_contents($this->jsonFilePath, json_encode($santriData, JSON_PRETTY_PRINT));
    }

    private function loadFromJsonFile()
    {
        $santriData = json_decode(file_get_contents($this->jsonFilePath), true);
        if (is_array($santriData)) {
            foreach ($santriData as $data) {
                $role = $this->roleModel->getRoleById($data['role']['roleId']);
                $santri = new Santri(
                    $data['userId'],
                    $data['username'],
                    $data['password'],
                    $role,
                    $data['santriId'],
                    $data['santriJenisKelamin'],
                    $data['santriTempatTglLahir'],
                    $data['santriAlamat'],
                    $data['santriNamaOrtu'],
                    $data['santriNoTelpOrtu'],
                    $data['santriGajiOrtu']
                );
                $this->santris[] = $santri;
            }
        }
    }

    public function getAllSantri()
    {
        return $this->santris;
    }

    private function getMaxSantriId()
    {
        $maxId = 0;
        foreach ($this->santris as $santri) {
            if ($santri->santriId > $maxId) {
                $maxId = $santri->santriId;
            }
        }
        return $maxId;
    }

    public function getSantriById($santriId)
    {
        foreach ($this->santris as $santri) {
            if ($santri->santriId == $santriId) {
                return $santri;
            }
        }
        return null;
    }

    public function getSantriByUsername($username)
    {
        foreach ($this->santris as $santri) {
            if ($santri->username == $username) {
                return $santri;
            }
        }
        return null;
    }

    public function updateSantri($username, $password, $santriId, $santriJenisKelamin, $santriTempatTglLahir, $santriAlamat, $santriNamaOrtu, $santriNoTelpOrtu, $santriGajiOrtu)
    {
        $santri = $this->getSantriById($santriId);

        $santri->username = $username;
        $santri->password = $password;
        $santri->santriJenisKelamin = $santriJenisKelamin;
        $santri->santriTempatTglLahir = $santriTempatTglLahir;
        $santri->santriAlamat = $santriAlamat;
        $santri->santriNamaOrtu = $santriNamaOrtu;
        $santri->santriNoTelpOrtu = $santriNoTelpOrtu;
        $santri->santriGajiOrtu = $santriGajiOrtu;
        $this->saveToJsonFile();
    }

    public function deleteSantri($santriId)
    {
        $santri = $this->getSantriById($santriId);
        $index = array_search($santri, $this->santris);
        if ($index !== false) {
            unset($this->santris[$index]);
            $this->santris = array_values($this->santris);
            $this->saveToJsonFile();
        }
    }
}
