<?php require_once 'service/auth.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input mapel</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <!-- Navbar -->
    <?php include 'views/includes/navbar.php'; ?>

    <!-- Main container -->
    <div class="flex">

        <!-- Main Content -->
        <div class="flex-1 p-20">
            <!-- Formulir Input mapel -->
            <div class="max-w-lg mx-auto bg-gradient-to-br from-white to-gray-100 p-8 rounded-2xl shadow-xl transform hover:shadow-2xl transition-all duration-300">
                <h2 class="text-xl font-bold mb-6 text-gray-800 text-center" style="font-family: 'Poppins', sans-serif;">Input Mapel</h2>
                <form action="index.php?modul=mapel&fitur=update" method="POST" class="space-y-6">
                    <input type="hidden" id="mapelId" name="mapelId" value="<?php echo htmlspecialchars($objMapels->mapelId); ?>">

                    <!-- Nama mapel -->
                    <div>
                        <label for="mapelNama" class="block text-gray-600 text-sm font-semibold mb-2">Nama mapel:</label>
                        <input type="text" id="mapelNama" name="mapelNama" class="shadow border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out hover:shadow-md"
                            placeholder="Masukkan Nama Mapel" required value="<?php echo isset($objMapels->mapelNama) ? htmlspecialchars($objMapels->mapelNama) : ''; ?>">
                    </div>

                    <!-- mapel Deskripsi -->
                    <div>
                        <label for="mapelDeskripsi" class="block text-gray-600 text-sm font-semibold mb-2">mapel Deskripsi:</label>
                        <textarea id="mapelDeskripsi" name="mapelDeskripsi" class="shadow border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out hover:shadow-md"
                            placeholder="Masukkan Deskripsi Mapel" rows="3" required><?php echo isset($objMapels->mapelDeskripsi) ? htmlspecialchars($objMapels->mapelDeskripsi) : ''; ?></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="kelasId" class="block text-sm font-medium text-gray-700">Pilih kelas</label>
                        <select id="kelasId" name="kelasId" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md">
                            <?php foreach ($objKelas as $kelas): ?>
                                <option value="<?= $kelas['id'] ?>"><?= $kelas['namaKelas'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>



                    <!-- Submit Button -->
                    <div class="flex justify-center">
                        <button type="submit" class="bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-indigo-600 hover:to-blue-500 text-white font-semibold py-2 px-6 rounded-lg shadow-lg transition-all duration-300 hover:shadow-2xl transform hover:scale-105">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>