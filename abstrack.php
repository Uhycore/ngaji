<?php
require_once 'config/mapelNode.php';

$mapel = new Mapel(20, "Matematika", "Pelajaran Matematika Dasar", 101);
echo "<pre>";
print_r($mapel->getInfo());
echo "</pre>";