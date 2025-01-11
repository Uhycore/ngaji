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
            <!-- Main Content -->
            <div class="flex-1 p-6 md:p-10">
                <div class="container mx-auto">
                    <!-- Heading and Insert Button -->
                    <div class="flex flex-col sm:flex-row justify-between items-center mb-6">
                        <h1 class="text-2xl sm:text-3xl font-semibold text-gray-700 mb-4 sm:mb-0">Role Management</h1>
                        <a href="index.php?modul=mapel&fitur=input" class="bg-blue-600 hover:bg-blue-500 text-white font-semibold py-2 px-6 sm:px-8 rounded-lg transition-all duration-300 ease-in-out shadow-lg hover:shadow-2xl transform hover:scale-105">
                            + Insert New Role
                        </a>
                    </div>

                    <!-- Roles Table -->
                    <div class="bg-white shadow rounded-lg overflow-x-auto">
                        <table class="min-w-full table-auto">
                            <thead class="bg-gray-800 text-white">
                                <tr>
                                    <th class="py-3 px-2 uppercase font-medium text-sm text-center border-r">Role ID</th>
                                    <th class="py-3 px-6 uppercase font-medium text-sm text-center border-r">Role Name</th>
                                    <th class="py-3 px-6 uppercase font-medium text-sm text-center border-r">Description</th>
                                    <th class="py-3 px-6 uppercase font-medium text-sm text-center border-r">Kelas</th>
                                    <th class="py-3 px-2 uppercase font-medium text-sm text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                <?php foreach ($Mapels as $index => $mapel) { ?>
                                    <tr class="border-t border-b transition-all duration-300 ease-in-out <?php echo $index % 2 == 1 ? 'bg-gray-200' : ''; ?>">

                                        <td class="py-4 px-2 text-center font-bold border-r border-gray-300"><?php echo htmlspecialchars($mapel->mapelId) ?></td>
                                        <td class="py-4 px-6 font-medium text-center border-r border-gray-300"><?php echo htmlspecialchars($mapel->mapelNama) ?></td>
                                        <td class="py-4 px-6 font-medium text-center border-r border-gray-300"><?php echo htmlspecialchars($mapel->mapelDeskripsi) ?></td>
                                        <td class="py-4 px-6 font-medium text-center border-r border-gray-300"><?php echo htmlspecialchars($mapel->kelasId['namaKelas']) ?></td>
                                        <td class="py-4 px-6 flex justify-center space-x-2">
                                            <form action="index.php?modul=mapel&fitur=edit&mapelId=<?= $mapel->mapelId ?>" method="POST" class="inline">
                                                <button type="submit" class="bg-transparent hover:bg-gray-200 p-1 rounded-lg transition-all duration-200 ease-in-out transform hover:scale-110">
                                                    <i class="fas fa-edit text-green-500 hover:text-green-700 w-4 h-4"></i>
                                                </button>
                                            </form>
                                            <form action="index.php?modul=mapel&fitur=delete" method="POST" class="inline">
                                                <input type="hidden" name="mapelId" value="<?php echo $mapel->mapelId; ?>">
                                                <button type="submit" class="bg-transparent hover:bg-gray-200 p-1 rounded-lg transition-all duration-200 ease-in-out transform hover:scale-110">
                                                    <i class="fas fa-trash-alt text-red-500 hover:text-red-700 w-4 h-4"></i>
                                                </button>
                                            </form>
                                        </td>
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
