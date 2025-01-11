<?php
if ($_SESSION['username_login'] == null) {
    echo "<script>
            alert('Anda harus login terlebih dahulu!');
            window.location.href = 'index.php';
        </script>";
    exit;
}
