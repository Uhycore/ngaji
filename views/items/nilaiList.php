<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Nilai</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script>
        function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
            document.body.style.overflow = 'hidden'; // Prevent scrolling when modal is open
        }

        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
            document.body.style.overflow = 'auto'; // Allow scrolling when modal is closed
        }
    </script>
</head>

<body class="bg-gray-100 font-sans antialiased leading-normal tracking-normal">

    <!-- Navbar -->
    <nav class="shadow-md bg-white mb-4">
        <?php include 'views/includes/navbar.php'; ?>
    </nav>

    <!-- Main container -->
    <div class="flex min-h-screen p-6">
        <div class="flex-1">
            <div class="container mx-auto">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-3xl font-semibold text-gray-800">Daftar Nilai Santri</h1>
                    <a href="index.php?modul=nilai&fitur=input" class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-indigo-600 hover:to-blue-600 text-white font-semibold py-3 px-6 rounded-lg shadow-lg transition-all duration-300 ease-in-out transform hover:scale-105">
                        <i class="fas fa-plus mr-2"></i>Tambah Nilai
                    </a>
                </div>

                <div class="bg-white shadow-xl rounded-lg overflow-hidden">
                    <table class="min-w-full table-fixed">
                        <thead class="bg-gradient-to-r from-gray-800 to-gray-600 text-white">
                            <tr>
                                <th class="py-4 px-1 uppercase font-semibold text-sm text-center border-r">ID Nilai</th>
                                <th class="py-4 px-6 uppercase font-semibold text-sm text-center border-r">Username Santri</th>
                                <th class="py-4 px-1 uppercase font-semibold text-sm text-center">Detail Nilai</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">


                            <?php foreach ($nilaiNodes as $index => $nilai) { ?>
                                <tr class="transition-all duration-200 hover:bg-gray-50">
                                    <td class="py-4 px-1 text-center font-medium border-r"><?php echo htmlspecialchars($nilai->nilaiId) ?></td>
                                    <td class="py-4 px-6 font-medium text-center border-r"><?php echo htmlspecialchars($nilai->santri['username']) ?></td>
                                    <td class="py-4 px-1 text-center">
                                        <button class="bg-transparent hover:bg-gray-200 p-2 rounded-full transition-all duration-200 ease-in-out transform hover:scale-110"
                                            onclick="openModal('modal-<?php echo $nilai->nilaiId; ?>')">
                                            <i class="far fa-list-alt text-blue-600 hover:text-blue-800 w-6 h-6"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal untuk detail nilai -->
    <?php if (!empty($nilaiNodes)) {
        foreach ($nilaiNodes as $nilai) { ?>
            <div id="modal-<?php echo $nilai->nilaiId; ?>" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden transition-all duration-300">
                <div class="bg-white rounded-lg shadow-xl w-3/4 max-w-3xl p-8 transform scale-95 transition-all duration-300 ease-in-out">
                    <h3 class="text-3xl font-semibold text-gray-800 mb-6">Detail Nilai: <?php echo htmlspecialchars($nilai->nilaiId); ?></h3>
                    <div class="overflow-hidden rounded-lg shadow border border-gray-200">
                        <table class="min-w-full bg-white">
                            <thead class="bg-gradient-to-r from-gray-800 to-gray-600 text-white">
                                <tr>
                                    <th class="py-3 px-2 text-mid font-semibold">Id Mapel</th>
                                    <th class="py-3 px-6 text-mid font-semibold">Mapel</th>
                                    <th class="py-3 px-6 text-mid font-semibold">Nilai</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <?php foreach ($nilai->detailNilai as $detail) { ?>
                                    <tr>
                                        <td class="py-3 px-6 text-center text-gray-700"><?php echo htmlspecialchars($detail->mapel->mapelId); ?></td>
                                        <td class="py-3 px-6 text-center text-gray-700"><?php echo htmlspecialchars($detail->mapel->mapelNama); ?></td>
                                        <td class="py-3 px-6 text-center text-gray-700"><?php echo htmlspecialchars($detail->nilai); ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-6 text-right">
                        <button class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-lg transition-all duration-200 ease-in-out"
                            onclick="closeModal('modal-<?php echo $nilai->nilaiId; ?>')">
                            Close
                        </button>
                    </div>
                </div>
            </div>
    <?php }
    } ?>
</body>

</html>