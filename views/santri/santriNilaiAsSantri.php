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
    <div class="m-6 rounded-lg mt-10 border border-gray-300 bg-white p-6 shadow-md">
        <h2 class="text-2xl font-semibold text-blue-800 mb-4 border-b border-gray-300 pb-2">Nilai:</h2>

        <!-- Jika Tidak Ada Nilai -->
        <?php if (empty($nilai->detailNilai)): ?>
            <p class="text-gray-600">Masih kosong</p>
        <?php else: ?>
            <!-- Tabel Nilai -->
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto border border-gray-300">
                    <thead class="bg-gray-200 text-gray-700 border-b border-gray-300">
                        <tr>
                            <th class="px-1 py-2 text-left border-r border-gray-300">ID</th>
                            <th class="px-4 py-2 text-left border-r border-gray-300">Mata Pelajaran</th>
                            <th class="px-4 py-2 text-left">Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $isEven = false; ?>
                        <?php foreach ($nilai->detailNilai as $detailNilai): ?>
                            <tr class="border-b border-gray-300 hover:bg-gray-50 transition duration-300 <?php echo $isEven ? 'bg-gray-100' : ''; ?>">
                                <td class="px-1 py-2 border-r border-gray-300"><?php echo htmlspecialchars($detailNilai->detailNilaiId); ?></td>
                                <td class="px-4 py-2 border-r border-gray-300"><?php echo htmlspecialchars($detailNilai->mapel->mapelNama); ?></td>
                                <td class="px-4 py-2"><?php echo htmlspecialchars($detailNilai->nilai); ?></td>
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