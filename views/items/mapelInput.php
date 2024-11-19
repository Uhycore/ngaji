<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Role</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <!-- Navbar -->
    <?php include 'views/includes/navbar.php'; ?>

    <!-- Main container -->
    <div class="flex">
        <!-- Sidebar -->


        <!-- Main Content -->
        <div class="flex-1 p-20">
            <!-- Formulir Input Role -->
            <div class="max-w-md mx-auto bg-gradient-to-br from-white to-gray-100 p-8 rounded-2xl shadow-xl">
                <h2 class="text-xl font-bold mb-6 text-gray-800 text-center" style="font-family: 'Poppins', sans-serif;">Input Maples</h2>
                <form action="index.php?modul=mapel&fitur=add" method="POST" class="space-y-6">
                    <!-- Nama Role -->
                    <div>
                        <label for="mapelNama" class="block text-gray-600 text-sm font-semibold mb-2">Nama Mapel</label>
                        <input type="text" id="mapelNama" name="mapelNama" class="w-full px-4 py-2 rounded-lg shadow-sm border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-300 focus:outline-none transition duration-200 hover:shadow-md"
                            placeholder="Masukkan Nama Mapel" required>
                    </div>

                    <!-- Role Deskripsi -->
                    <div>
                        <label for="mapelDeskripsi" class="block text-gray-600 text-sm font-semibold mb-2">Mapel Deskripsi</label>
                        <textarea id="mapelDeskripsi" name="mapelDeskripsi" class="w-full px-4 py-2 rounded-lg shadow-sm border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-300 focus:outline-none transition duration-200 hover:shadow-md"
                            placeholder="Masukkan Deskripsi Mapel" rows="3" required></textarea>
                    </div>

                

                    <!-- Submit Button -->
                    <div class="flex justify-center mt-6">
                        <button type="submit" class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold py-2 px-6 rounded-full transition duration-300 shadow-lg hover:shadow-2xl transform hover:scale-105">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>