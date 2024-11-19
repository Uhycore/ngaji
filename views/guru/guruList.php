<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guru Management</title>

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
                    <h1 class="text-2xl font-semibold text-gray-700">Guru Management</h1>
                    <a href="index.php?modul=guru&fitur=input" class="bg-blue-600 hover:bg-blue-500 text-white font-semibold py-2 px-6 rounded-lg transition-all duration-300 ease-in-out shadow-lg hover:shadow-2xl transform hover:scale-105">
                        + Insert New Guru
                    </a>
                </div>

                <!-- Guru Table -->
                <div class="bg-white shadow rounded-lg overflow-x-auto">
                    <table class="min-w-full table-auto">
                        <thead class="bg-gray-800 text-white">
                            <tr>
                                <th class="py-3 px-4 uppercase font-medium text-sm text-center border-b">Guru ID</th>
                                <th class="py-3 px-4 uppercase font-medium text-sm text-center border-b">Nama</th>
                                <th class="py-3 px-4 uppercase font-medium text-sm text-center border-b">Password</th>
                                <th class="py-3 px-4 uppercase font-medium text-sm text-center border-b">Role</th>
                                <th class="py-3 px-4 uppercase font-medium text-sm text-center border-b">Jenis Kelamin</th>
                                <th class="py-3 px-4 uppercase font-medium text-sm text-center border-b">Tempat, Tgl Lahir</th>
                                <th class="py-3 px-4 uppercase font-medium text-sm text-center border-b">Kelas</th>
                                <th class="py-3 px-4 uppercase font-medium text-sm text-center border-b">Alamat</th>
                                <th class="py-3 px-4 uppercase font-medium text-sm text-center border-b">No Telp</th>
                                <th class="py-3 px-4 uppercase font-medium text-sm text-center border-b">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            <?php if (!empty($gurus)) {
                                foreach ($gurus as $index => $guru) { ?>
                                    <tr class="border-t border-b transition-all duration-300 ease-in-out <?php echo $index % 2 == 1 ? 'bg-gray-200' : ''; ?>">
                                        <td class="py-4 px-4 text-center"><?php echo htmlspecialchars($guru->guruId); ?></td>
                                        <td class="py-4 px-4 text-center"><?php echo htmlspecialchars($guru->username); ?></td>
                                        <td class="py-4 px-4 text-center"><?php echo htmlspecialchars($guru->password); ?></td>
                                        <td class="py-4 px-4 text-center"><?php echo htmlspecialchars($guru->role->roleNama); ?></td>
                                        <td class="py-4 px-4 text-center"><?php echo htmlspecialchars($guru->guruJenisKelamin); ?></td>
                                        <td class="py-4 px-4 text-center"><?php echo htmlspecialchars($guru->guruTempatTglLahir); ?></td>
                                        <td class="py-4 px-4 text-center"><?php echo htmlspecialchars($guru->guruKelas); ?></td>
                                        <td class="py-4 px-4 text-center"><?php echo htmlspecialchars($guru->guruAlamat); ?></td>
                                        <td class="py-4 px-4 text-center"><?php echo htmlspecialchars($guru->guruNoTelp); ?></td>
                                        <td class="py-4 px-4 flex justify-center space-x-2">
                                            <form action="index.php?modul=guru&fitur=edit&guruId=<?= $guru->guruId ?>" method="POST" class="inline">
                                                <button type="submit" class="bg-transparent hover:bg-gray-200 p-1 rounded-lg transition-all duration-200 ease-in-out transform hover:scale-110">
                                                    <i class="fas fa-edit text-green-500 hover:text-green-700 w-4 h-4"></i>
                                                </button>
                                            </form>
                                            <form action="index.php?modul=guru&fitur=delete" method="POST" class="inline">
                                                <input type="hidden" name="guruId" value="<?php echo $guru->guruId; ?>">
                                                <button type="submit" class="bg-transparent hover:bg-gray-200 p-1 rounded-lg transition-all duration-200 ease-in-out transform hover:scale-110">
                                                    <i class="fas fa-trash-alt text-red-500 hover:text-red-700 w-4 h-4"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php }
                            } else { ?>
                                <tr>
                                    <td colspan="10" class="text-center py-4">No gurus found.</td>
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