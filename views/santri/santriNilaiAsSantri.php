<?php require_once 'service/auth.php'; ?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nilai Santri</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-gray-100 font-sans">

    <!-- Navigation Bar -->
    <nav class="shadow-sm bg-white mb-4">
        <?php include 'views/includes/navbar.php'; ?>
    </nav>

    <!-- Main Content -->
    <div class="m-6 max-w-6xl mx-auto rounded-lg mt-10 border border-gray-300 bg-white p-6 shadow-md">
        <h2 class="text-2xl font-semibold text-blue-800 mb-6 border-b border-gray-300 pb-2">Nilai Santri</h2>

        <!-- Jika Tidak Ada Nilai -->
        <?php foreach ($nilai as $nilai) ?>


        <?php if (empty($nilai->detailNilai)): ?>

            <p class="text-gray-600">Masih kosong</p>
        <?php else: ?>
            <!-- Tabel Nilai -->
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto border-collapse text-gray-700">
                    <thead class="bg-blue-100 text-gray-700 border-b border-gray-300">
                        <tr>
                            <th class="px-1 py-3 text-center border-r border-gray-300">Id Mapel</th>
                            <th class="px-6 py-3 text-left border-r border-gray-300">Mata Pelajaran</th>
                            <th class="px-6 py-3 text-left">Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $isEven = false; ?>
                        <?php foreach ($nilai->detailNilai as $detailNilai): ?>
                            <tr class="border-b border-gray-300 hover:bg-gray-50 transition duration-300 <?php echo $isEven ? 'bg-gray-50' : ''; ?>">
                                <td class="px-1 py-3 text-center border-r border-gray-300"><?php echo htmlspecialchars($detailNilai->mapel->mapelId); ?></td>
                                <td class="px-6 py-3 border-r border-gray-300"><?php echo htmlspecialchars($detailNilai->mapel->mapelNama); ?></td>
                                <td class="px-6 py-3"><?php echo htmlspecialchars($detailNilai->nilai); ?></td>
                            </tr>
                            <?php $isEven = !$isEven; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>


    </div>

</body>

</html>