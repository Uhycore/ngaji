<?php
require_once 'models/kelasModel.php';

$data = new KelasModel;

$a = $data->getAllKelas();

echo "<pre>";
print_r($a);
echo "</pre>";


$b = $data->getKelasById(101);

echo "<pre>";
print_r($b);
echo "</pre>";