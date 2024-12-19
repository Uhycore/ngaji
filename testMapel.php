<?php
require_once 'models/mapelModel.php';

$data = new MapelModel();

$a = $data->getAllMapel();

echo "<pre>";
print_r($a);
echo "</pre>";
