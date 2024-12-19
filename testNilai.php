<?php
require_once 'models/nilaiModel.php';

$data = new NilaiModel;

$a = $data->getAllNilai();

echo "<pre>";
print_r($a);
echo "</pre>";