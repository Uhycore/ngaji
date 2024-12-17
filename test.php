<?php
require_once 'models/adminModel.php'; // Pastikan path ke adminModel.php sesuai
// Pastikan path ke roleModel.php sesuai

// Buat instance AdminModel
$adminModel = new AdminModel();

$a = $adminModel->getAllAdmins();

echo "<pre>";
print_r($a);
echo "</pre>";
