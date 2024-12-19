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
                    <a href="index.php?modul=kelas&fitur=input" class="bg-blue-600 hover:bg-blue-500 text-white font-semibold py-2 px-6 rounded-lg transition-all duration-300 ease-in-out shadow-lg hover:shadow-2xl transform hover:scale-105">
                        + Insert New Guru
                    </a>
                </div>

                <!-- Guru Table -->
                <div class="bg-white shadow rounded-lg overflow-x-auto">
                    <table class="min-w-full table-auto">
                        <thead class="bg-gray-800 text-white">
                            <tr>
                                <th class="py-3 px-4 uppercase font-medium text-sm text-center border-b">Code kelas</th>
                                <th class="py-3 px-4 uppercase font-medium text-sm text-center border-b">Kelas</th>
                                <th class="py-3 px-4 uppercase font-medium text-sm text-center border-b">Nama Pengajar</th>
                                <th class="py-3 px-4 uppercase font-medium text-sm text-center border-b">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            <?php if (!empty($kelasList)) {
                                foreach ($kelasList as $index => $kelas) { ?>
                                    <tr class="border-t border-b transition-all duration-300 ease-in-out <?php echo $index % 2 == 1 ? 'bg-gray-200' : ''; ?>">
                                        <td class="py-4 px-4 text-center"><?php echo htmlspecialchars($kelas['id']); ?></td>
                                        <td class="py-4 px-4 text-center"><?php echo htmlspecialchars($kelas['namaKelas']); ?></td>
                                        <td class="py-4 px-4 text-center"><?php echo htmlspecialchars($kelas['guruId']['username']); ?></td>
                                        

                                        <td class="py-4 px-4 flex justify-center space-x-2">
                                            <form action="index.php?modul=kelas&fitur=edit&idKelas=<?= $kelas['id'] ?>" method="POST" class="inline">
                                                <button type="submit" class="bg-transparent hover:bg-gray-200 p-1 rounded-lg transition-all duration-200 ease-in-out transform hover:scale-110">
                                                    <i class="fas fa-edit text-green-500 hover:text-green-700 w-4 h-4"></i>
                                                </button>
                                            </form>
                                            <form action="index.php?modul=kelas&fitur=delete" method="POST" class="inline">
                                                <input type="hidden" name="idKelas" value="<?php echo $kelas['id']; ?>">
                                                <button type="submit" class="bg-transparent hover:bg-gray-200 p-1 rounded-lg transition-all duration-200 ease-in-out transform hover:scale-110">
                                                    <i class="fas fa-trash-alt text-red-500 hover:text-red-700 w-4 h-4"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php }
                            } else { ?>
                                <tr>
                                    <td colspan="10" class="text-center py-4">No kelas$kelasList found.</td>
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