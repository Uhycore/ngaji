<?php require_once 'service/auth.php'; ?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 font-sans antialiased leading-normal tracking-normal h-full">
    <!-- Navbar -->
    <nav class="shadow-sm bg-white">
        <?php include 'views/includes/navbar.php'; ?>
    </nav>
    <!-- Layout Wrapper -->
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-48 bg-gray-200">
            <?php include 'views/includes/sidebar.php'; ?>
        </aside>
        <!-- Main Content -->
        <main class="flex-grow p-4">
            <div class="flex-1 p-4 md:p-10">
                <div class="container mx-auto">
                    <!-- Heading and Insert Button -->
                    <div class="flex flex-col md:flex-row justify-between items-center mb-6 space-y-4 md:space-y-0">
                        <h1 class="text-xl md:text-2xl font-semibold text-gray-700">Santri Management</h1>
                        <a href="index.php?modul=santri&fitur=input"
                            class="bg-blue-600 hover:bg-blue-500 text-white font-semibold py-2 px-4 md:py-2 md:px-6 rounded-lg transition-all duration-300 ease-in-out shadow-lg hover:shadow-2xl transform hover:scale-105 text-sm md:text-base">
                            + Insert New Santri
                        </a>
                    </div>

                    <!-- Santri Table -->
                    <div class="bg-white shadow rounded-lg overflow-x-auto">
                        <table class="min-w-full table-auto text-xs md:text-sm">
                            <thead class="bg-gray-800 text-white">
                                <tr>
                                    <th class="py-2 px-3 uppercase font-medium text-center border-b">Santri ID</th>
                                    <th class="py-2 px-3 uppercase font-medium text-center border-b">Nama</th>
                                    <th class="py-2 px-3 uppercase font-medium text-center border-b">Password</th>
                                    <th class="py-2 px-3 uppercase font-medium text-center border-b">Jenis Kelamin</th>
                                    <th class="py-2 px-3 uppercase font-medium text-center border-b">Tempat, Tgl Lahir</th>
                                    <th class="py-2 px-3 uppercase font-medium text-center border-b">Alamat</th>
                                    <th class="py-2 px-3 uppercase font-medium text-center border-b">Nama Ortu</th>
                                    <th class="py-2 px-3 uppercase font-medium text-center border-b">No Telp Ortu</th>
                                    <th class="py-2 px-3 uppercase font-medium text-center border-b">Gaji Ortu</th>
                                    <th class="py-2 px-3 uppercase font-medium text-center border-b">Kelas</th>
                                    <th class="py-2 px-3 uppercase font-medium text-center border-b">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                <?php if (!empty($santris)) {
                                    foreach ($santris as $index => $santri) { ?>
                                        <tr class="border-t border-b transition-all duration-300 ease-in-out <?php echo $index % 2 == 1 ? 'bg-gray-200' : ''; ?>">
                                            <td class="py-2 px-3 text-center"><?php echo htmlspecialchars($santri['id']); ?></td>
                                            <td class="py-2 px-3 text-center"><?php echo htmlspecialchars($santri['username']); ?></td>
                                            <td class="py-2 px-3 text-center"><?php echo htmlspecialchars($santri['password']); ?></td>
                                            <td class="py-2 px-3 text-center"><?php echo htmlspecialchars($santri['santriJenisKelamin']); ?></td>
                                            <td class="py-2 px-3 text-center"><?php echo htmlspecialchars($santri['santriTempatTglLahir']); ?></td>
                                            <td class="py-2 px-3 text-center"><?php echo htmlspecialchars($santri['santriAlamat']); ?></td>
                                            <td class="py-2 px-3 text-center"><?php echo htmlspecialchars($santri['santriNamaOrtu']); ?></td>
                                            <td class="py-2 px-3 text-center"><?php echo htmlspecialchars($santri['santriNoTelpOrtu']); ?></td>
                                            <td class="py-2 px-3 text-center"><?php echo htmlspecialchars($santri['santriGajiOrtu']); ?></td>
                                            <td class="py-2 px-3 text-center"><?php echo htmlspecialchars($santri['idKelas']['namaKelas']); ?></td>
                                            <td class="py-2 px-3 flex justify-center space-x-2">
                                                <form action="index.php?modul=santri&fitur=edit&santriId=<?= $santri['id'] ?>" method="POST" class="inline">
                                                    <button type="submit"
                                                        class="bg-transparent hover:bg-gray-200 p-1 rounded-lg transition-all duration-200 ease-in-out transform hover:scale-110">
                                                        <i class="fas fa-edit text-green-500 hover:text-green-700 w-4 h-4"></i>
                                                    </button>
                                                </form>
                                                <form action="index.php?modul=santri&fitur=delete" method="POST" class="inline">
                                                    <input type="hidden" name="santriId" value="<?php echo $santri['id']; ?>">
                                                    <button type="submit"
                                                        class="bg-transparent hover:bg-gray-200 p-1 rounded-lg transition-all duration-200 ease-in-out transform hover:scale-110">
                                                        <i class="fas fa-trash-alt text-red-500 hover:text-red-700 w-4 h-4"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php }
                                } else { ?>
                                    <tr>
                                        <td colspan="11" class="text-center py-4">No santris found.</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </main>
    </div>
</body>


</html>
