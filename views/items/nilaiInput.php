<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Nilai</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Include jQuery -->
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <!-- Navbar -->
    <?php include 'views/includes/navbar.php'; ?>

    <div class="flex justify-center items-center h-screen">
        <div class="flex-1 p-8 max-w-4xl w-full">
            <div class="container mx-auto">
                <h2 class="text-3xl font-semibold text-gray-900 mb-6 text-center">Input Nilai Santri</h2>
                <form action="index.php?modul=nilai&fitur=add" method="POST" class="bg-white p-8 rounded-lg shadow-lg">
                    <div class="mb-6">

                        <select name="santriId" id="santriId" class="w-full p-2 border border-gray-300 rounded mt-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <?php foreach ($santris as $santri) { ?>
                                <option value="<?php echo htmlspecialchars($santri['santriId']); ?>">
                                    <?php echo htmlspecialchars($santri['username']); ?>
                                </option>
                            <?php } ?>
                        </select>


                        <button type="button" id="searchBtn" class="mt-2 bg-blue-500 text-white px-4 py-2 rounded">OK</button>
                    </div>

                    <p id="usernameDisplay" class="mt-4 text-gray-800"></p> <!-- Menampilkan username yang dipilih -->

                    <div id="nilai-inputs">
                        <?php foreach ($mapels as $mapel) { ?>
                            <div class="mb-4 flex items-center justify-between">
                                <span class="text-gray-800 text-lg font-medium"><?php echo htmlspecialchars($mapel->mapelNama); ?></span>
                                <input type="hidden" name="mapelId[]" value="<?php echo htmlspecialchars($mapel->mapelId); ?>">

                                <?php
                                $nilaiValue = 0; 
                                if ($objNilai) {
                                    foreach ($objNilai->detailNilai as $detail) {
                                        if ($detail->mapel->mapelId == $mapel->mapelId) {
                                            $nilaiValue = $detail->nilai;
                                            break;
                                        }
                                    }
                                }
                                ?>

                                <input type="number" name="nilai[]" class="w-1/3 p-2 border border-gray-300 rounded mt-2 focus:outline-none focus:ring-2 focus:ring-blue-500" value="<?php echo $nilaiValue; ?>" required>
                            </div>
                        <?php } ?>
                       
                    </div>


                    <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white font-semibold py-3 rounded mt-6">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('searchBtn').addEventListener('click', function() {
            // Ambil elemen select
            var selectElement = document.getElementById('santriId');

            // Ambil nilai yang dipilih
            var santriId = selectElement.value;

            // Redirect ke URL dengan query string yang mencantumkan santriId
            window.location.href = 'index.php?modul=nilai&fitur=input&santriId=' + santriId;
        });
    </script>

</body>

</html>