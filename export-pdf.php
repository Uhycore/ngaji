<?php
require_once __DIR__ . '/vendor/autoload.php';
session_start();


$santri = [
    'username' => $_SESSION['username_login']['username'],
    'idKelas' => $_SESSION['username_login']['idKelas']['namaKelas'],
    'santriJenisKelamin' => $_SESSION['username_login']['santriJenisKelamin'],
    'santriTempatTglLahir' => $_SESSION['username_login']['santriTempatTglLahir'],
    'santriAlamat' => $_SESSION['username_login']['santriAlamat'],
    'santriNamaOrtu' => $_SESSION['username_login']['santriNamaOrtu'],
    'santriNoTelpOrtu' => $_SESSION['username_login']['santriNoTelpOrtu'],
    'santriGajiOrtu' => $_SESSION['username_login']['santriGajiOrtu'],
];


$mpdf = new \Mpdf\Mpdf();


$html = "
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Profil Santri</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            color: #333;
        }
        .container {
            padding: 20px;
        }
        .header {
            text-align: center;
            padding: 10px 0;
            background-color: #007bff;
            color: white;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .section {
            margin: 20px 0;
        }
        .section h2 {
            font-size: 18px;
            border-bottom: 2px solid #007bff;
            padding-bottom: 5px;
            color: #007bff;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .table th {
            background-color: #007bff;
            color: white;
        }
        .table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .table tr:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>
    <div class='container'>
        <div class='header'>
            <h1>Profil Santri</h1>
        </div>
        
        <div class='section'>
            <h2>Data Santri</h2>
            <table class='table'>
                <tr>
                    <th>Username</th>
                    <td>{$santri['username']}</td>
                </tr>
                <tr>
                    <th>Kelas</th>
                    <td>{$santri['idKelas']}</td>
                </tr>
                <tr>
                    <th>Jenis Kelamin</th>
                    <td>{$santri['santriJenisKelamin']}</td>
                </tr>
                <tr>
                    <th>Tempat & Tanggal Lahir</th>
                    <td>{$santri['santriTempatTglLahir']}</td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td>{$santri['santriAlamat']}</td>
                </tr>
            </table>
        </div>
        
        <div class='section'>
            <h2>Data Orang Tua</h2>
            <table class='table'>
                <tr>
                    <th>Nama Orang Tua</th>
                    <td>{$santri['santriNamaOrtu']}</td>
                </tr>
                <tr>
                    <th>No Telepon Orang Tua</th>
                    <td>{$santri['santriNoTelpOrtu']}</td>
                </tr>
                <tr>
                    <th>Gaji Orang Tua</th>
                    <td>Rp " . number_format($santri['santriGajiOrtu'], 0, ',', '.') . "</td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
";

$mpdf->WriteHTML($html);

$mpdf->Output('profil-santri.pdf', 'D');