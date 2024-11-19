<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Santri Management</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans antialiased leading-normal tracking-normal">

    <!-- Navbar -->
    <nav class="shadow-sm bg-white mb-1">
        <?php include 'views/includes/navbar.php'; ?>
    </nav>

    <!-- Main container -->
    <div class="flex min-h-screen">
        <!-- Main Content -->
        <div class="flex-1 p-10">
            <div class="container mx-auto">
                <!-- Heading and Insert Button -->
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-semibold text-gray-700">Santri Management</h1>
                    <a href="index.php?modul=santri&fitur=input" class="bg-blue-600 to-indigo-600 hover:from-indigo-600 hover:to-blue-500 text-white font-semibold py-2 px-6 rounded-lg transition-all duration-300 ease-in-out shadow-lg hover:shadow-2xl transform hover:scale-105">
                        + Insert New Santri
                    </a>
                </div>

                <!-- Santri Table -->
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    <table class="min-w-full table-fixed">
                        <thead class="bg-gray-800 text-white">
                            <tr>
                                <th class="py-3 px-2 uppercase font-medium text-sm text-center border-r">Santri ID</th>
                                <th class="py-3 px-6 uppercase font-medium text-sm text-center border-r">Nama</th>
                                <th class="py-3 px-6 uppercase font-medium text-sm text-center border-r">Password</th>
                                <th class="py-3 px-6 uppercase font-medium text-sm text-center border-r">Jenis Kelamin</th>
                                <th class="py-3 px-6 uppercase font-medium text-sm text-center border-r">Tempat, Tgl Lahir</th>
                                <th class="py-3 px-6 uppercase font-medium text-sm text-center border-r">Alamat</th>
                                <th class="py-3 px-6 uppercase font-medium text-sm text-center border-r">Nama Ortu</th>
                                <th class="py-3 px-6 uppercase font-medium text-sm text-center border-r">No Telp Ortu</th>
                                <th class="py-3 px-6 uppercase font-medium text-sm text-center border-r">Gaji Ortu</th>
                                <th class="py-3 px-2 uppercase font-medium text-sm text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            <?php if (!empty($santris)) {
                                foreach ($santris as $index => $santri) { ?>
                                    <tr class="border-t border-b transition-all duration-300 ease-in-out <?php echo $index % 2 == 1 ? 'bg-gray-200' : ''; ?>">
                                        <td class="py-4 px-2 text-center font-bold text-black-500"><?php echo htmlspecialchars($santri->santriId); ?></td>
                                        <td class="py-4 px-6 text-center border border-gray-300"><?php echo htmlspecialchars($santri->username); ?></td>
                                        <td class="py-4 px-6 text-center border border-gray-300"><?php echo htmlspecialchars($santri->password); ?></td>
                                        <td class="py-4 px-6 text-center border border-gray-300"><?php echo htmlspecialchars($santri->santriJenisKelamin); ?></td>
                                        <td class="py-4 px-6 text-center border border-gray-300"><?php echo htmlspecialchars($santri->santriTempatTglLahir); ?></td>
                                        <td class="py-4 px-6 text-center border border-gray-300"><?php echo htmlspecialchars($santri->santriAlamat); ?></td>
                                        <td class="py-4 px-6 text-center border border-gray-300"><?php echo htmlspecialchars($santri->santriNamaOrtu); ?></td>
                                        <td class="py-4 px-6 text-center border border-gray-300"><?php echo htmlspecialchars($santri->santriNoTelpOrtu); ?></td>
                                        <td class="py-4 px-6 text-center border border-gray-300"><?php echo htmlspecialchars($santri->santriGajiOrtu); ?></td>
                                        <td class="py-4 px-6 flex justify-center space-x-2 border-gray-300">
                                            <form action="index.php?modul=santri&fitur=edit&santriId=<?= $santri->santriId ?>" method="POST" class="inline">
                                                <button type="submit" class="bg-transparent hover:bg-gray-200 p-1 rounded-lg transition-all duration-200 ease-in-out transform hover:scale-110">
                                                    <i class="fas fa-edit text-green-500 hover:text-green-700 w-4 h-4"></i>
                                                </button>
                                            </form>
                                            <form action="index.php?modul=santri&fitur=delete" method="POST" class="inline">
                                                <input type="hidden" name="santriId" value="<?php echo $santri->santriId; ?>">
                                                <button type="submit" class="bg-transparent hover:bg-gray-200 p-1 rounded-lg transition-all duration-200 ease-in-out transform hover:scale-110">
                                                    <i class="fas fa-trash-alt text-red-500 hover:text-red-700 w-4 h-4"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php }
                            } else { ?>
                                <tr>
                                    <td colspan="9" class="text-center py-4">No santris found.</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>

</html>