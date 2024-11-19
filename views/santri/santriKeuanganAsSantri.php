<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keuangan Santri</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-gray-100 font-sans">
    <nav class="shadow-sm bg-white mb-1">
        <?php include 'views/includes/navbar.php'; ?>
    </nav>

    <div class="max-w-4xl mx-auto p-8 bg-white shadow-lg rounded-lg mt-10">
        <h1 class="text-3xl font-semibold text-center text-gray-800 mb-6">Keuangan Santri</h1>

        <!-- Tampilkan Profil Santri -->
        <div class="bg-blue-100 p-6 rounded-lg shadow-md mb-8">
            <img class="w-32 h-32 rounded-full mx-auto mb-4" src="assets/profil.jpg" alt="Profil Santri">
            <h2 class="text-2xl font-semibold text-center text-blue-800"><?php echo htmlspecialchars($santri->username); ?></h2>
        </div>

        <!-- Tampilkan Detail Keuangan Santri -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden border border-gray-200 p-6 hover:shadow-xl transition duration-300">
            <h2 class="text-2xl font-semibold text-blue-800 mb-4">Detail Keuangan:</h2>

            <?php if (empty($keuangan->detailKeuangan)): ?>
                <p class="text-gray-600">Masih kosong</p>
            <?php else: ?>
                <table class="min-w-full table-auto border-collapse">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="px-4 py-2 text-left">Tanggal</th>
                            <th class="px-4 py-2 text-left">Nominal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($keuangan->detailKeuangan as $detailKeuangan): ?>
                            <tr class="border-b">
                                <td class="px-4 py-2"><?php echo htmlspecialchars($detailKeuangan->tanggal); ?></td>
                                <td class="px-4 py-2">Rp <?php echo number_format($detailKeuangan->nominal, 0, ',', '.'); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>