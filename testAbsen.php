<?php
require_once 'models/absenModel.php';

$data = new AbsenModel;

$a = $data->getAllAbsen();

echo "<pre>";
print_r($a);
echo "</pre>";
