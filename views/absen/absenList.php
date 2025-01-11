<?php require_once 'service/auth.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absen Management</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body class="bg-gray-100 font-sans antialiased leading-normal tracking-normal">

    <!-- Navbar -->
    <nav class="shadow-sm bg-white mb-1">
        <?php include 'views/includes/navbar.php'; ?>
    </nav>

    <!-- Main container -->
    <div class="flex flex-col min-h-screen">
        <!-- Main Content -->
        <div class="flex-1 p-4 md:p-10">
            <div class="container mx-auto">
                <!-- Heading and Insert Button -->
                <div class="flex flex-col md:flex-row justify-between items-center mb-6 space-y-4 md:space-y-0">
                    <h1 class="text-xl md:text-2xl font-semibold text-gray-700">Absen Management</h1>
                    <a href="index.php?modul=absen&fitur=input"
                        class="bg-blue-600 hover:bg-blue-500 text-white font-semibold py-2 px-4 md:py-2 md:px-6 rounded-lg transition-all duration-300 ease-in-out shadow-lg hover:shadow-2xl transform hover:scale-105 text-sm md:text-base">
                        + Add New Absen
                    </a>
                </div>

                <!-- Absen Table -->
                <div class="bg-white shadow rounded-lg overflow-x-auto">
                    <table class="min-w-full table-auto text-xs md:text-sm">
                        <thead class="bg-gray-800 text-white">
                            <tr>
                                <th class="py-2 px-3 uppercase font-medium text-center border-b">ID Absen</th>
                                <th class="py-2 px-3 uppercase font-medium text-center border-b">ID User</th>
                                <th class="py-2 px-3 uppercase font-medium text-center border-b">Tanggal</th>
                                <th class="py-2 px-3 uppercase font-medium text-center border-b">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            <?php
                            if (!empty($hasil)) {
                                // Sort hasil by id in ascending order
                                usort($hasil, function ($a, $b) {
                                    return $a->id <=> $b->id;
                                });

                                // Loop through sorted hasil
                                foreach ($hasil as $index => $absen) { ?>
                                    <tr class="border-t border-b transition-all duration-300 ease-in-out <?php echo $index % 2 == 1 ? 'bg-gray-200' : ''; ?>">
                                        <td class="py-2 px-3 text-center">
                                            <?php echo isset($absen->id) ? htmlspecialchars($absen->id) : 'N/A'; ?>
                                        </td>
                                        <td class="py-2 px-3 text-center">
                                            <?php echo isset($absen->idSantri['username']) ? htmlspecialchars($absen->idSantri['username']) : 'N/A'; ?>
                                        </td>
                                        <td class="py-2 px-3 text-center">
                                            <?php echo isset($absen->tanggal) ? htmlspecialchars($absen->tanggal) : 'N/A'; ?>
                                        </td>
                                        <td class="py-2 px-3 flex justify-center space-x-2">
                                            <form action="index.php?modul=absen&fitur=edit&idAbsen=<?= $absen->id ?? '' ?>" method="POST" class="inline">
                                                <button type="submit"
                                                    class="bg-transparent hover:bg-gray-200 p-1 rounded-lg transition-all duration-200 ease-in-out transform hover:scale-110">
                                                    <i class="fas fa-edit text-green-500 hover:text-green-700 w-4 h-4"></i>
                                                </button>
                                            </form>
                                            <form action="index.php?modul=absen&fitur=delete" method="POST" class="inline">
                                                <input type="hidden" name="idAbsen" value="<?php echo $absen->id ?? ''; ?>">
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
                                    <td colspan="4" class="text-center py-4">No absens found.</td>
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