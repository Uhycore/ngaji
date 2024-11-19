<?php
require_once 'config/guruNode.php';

class GuruModel
{
    private $gurus = [];
    private $nextIdGuru = 1;
    private $roleModel;
    private $jsonFilePath = 'data/gurus.json';

    public function __construct()
    {
        $this->roleModel = new RoleModel();

        if (file_exists($this->jsonFilePath)) {
            $this->loadFromJsonFile();
            $this->nextIdGuru = $this->getMaxGuruId() + 1;
        } else {
            $this->initializeDefaultUser();
            $this->saveToJsonFile();
        }
    }

    public function initializeDefaultUser()
    {
        $this->addGuru('Arilguru', '1', 2, 'Laki-laki', 'Jakarta/1 Jan 1990', 'Kelas 1', 'Jl. Raya Jakarta', '0123456789');
        $this->addGuru('Mubinguru', '1', 2, 'Laki-laki', 'Jakarta/1 Jan 1990', 'Kelas 2', 'Jl. Raya Jakarta', '0123456789');
    }

    public function addGuru($username, $password, $roleId, $jenisKelamin, $tempatTglLahir, $kelas, $alamat, $noTelp)
    {
        $role = $this->roleModel->getRoleById($roleId);
        $guru = new Guru(2, $username, $password, $role, $this->nextIdGuru++, $jenisKelamin, $tempatTglLahir, $kelas, $alamat, $noTelp);
        $this->gurus[] = $guru;
        $this->saveToJsonFile();
    }

    private function saveToJsonFile()
    {
        $guruData = array_map(function ($guru) {
            return [
                'userId' => $guru->userId,
                'username' => $guru->username,
                'password' => $guru->password,
                'role' => $guru->role,
                'guruId' => $guru->guruId,
                'guruJenisKelamin' => $guru->guruJenisKelamin,
                'guruTempatTglLahir' => $guru->guruTempatTglLahir,
                'guruKelas' => $guru->guruKelas,
                'guruAlamat' => $guru->guruAlamat,
                'guruNoTelp' => $guru->guruNoTelp,
            ];
        }, $this->gurus);

        file_put_contents($this->jsonFilePath, json_encode($guruData, JSON_PRETTY_PRINT));
    }

    private function loadFromJsonFile()
    {
        $guruData = json_decode(file_get_contents($this->jsonFilePath), true);
        if (is_array($guruData)) {
            foreach ($guruData as $data) {
                $role = $this->roleModel->getRoleById($data['role']['roleId']);
                $guru = new Guru(
                    $data['userId'],
                    $data['username'],
                    $data['password'],
                    $role,
                    $data['guruId'],
                    $data['guruJenisKelamin'],
                    $data['guruTempatTglLahir'],
                    $data['guruKelas'],
                    $data['guruAlamat'],
                    $data['guruNoTelp']
                );
                $this->gurus[] = $guru;
            }
        }
    }

    public function getAllGurus()
    {
        return $this->gurus;
    }

    private function getMaxGuruId()
    {
        $maxId = 0;
        foreach ($this->gurus as $guru) {
            if ($guru->guruId > $maxId) {
                $maxId = $guru->guruId;
            }
        }
        return $maxId;
    }

    public function getGuruById($guruId)
    {
        foreach ($this->gurus as $guru) {
            if ($guru->guruId == $guruId) {
                return $guru;
            }
        }
        return null;
    }
    public function getGuruByUsername($username)
    {
        foreach ($this->gurus as $guru) {
            if ($guru->username == $username) {
                return $guru;
            }
        }
        return null;
    }

    public function updateGuru($guruId, $username, $password, $jenisKelamin, $tempatTglLahir, $kelas, $alamat, $noTelp)
    {
        $guru = $this->getGuruById($guruId);
        if ($guru) {
            $guru->username = $username;
            $guru->password = $password;
            $guru->guruJenisKelamin = $jenisKelamin;
            $guru->guruTempatTglLahir = $tempatTglLahir;
            $guru->guruKelas = $kelas;
            $guru->guruAlamat = $alamat;
            $guru->guruNoTelp = $noTelp;
            $this->saveToJsonFile();
        }
    }

    public function deleteGuru($guruId)
    {
        $guru = $this->getGuruById($guruId);
        $index = array_search($guru, $this->gurus);
        if ($index !== false) {
            unset($this->gurus[$index]);
            $this->gurus = array_values($this->gurus);
            $this->saveToJsonFile();
        }
    }
}
