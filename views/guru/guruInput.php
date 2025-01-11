<?php require_once 'service/auth.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Guru</title>

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
            <!-- Formulir Input Guru -->
            <div class="max-w-md mx-auto bg-gradient-to-br from-white to-gray-100 p-8 rounded-2xl shadow-xl">
                <h2 class="text-xl font-bold mb-6 text-gray-800 text-center" style="font-family: 'Poppins', sans-serif;">Input Guru</h2>
                <form action="index.php?modul=guru&fitur=add" method="POST" class="space-y-6">
                    <!-- Username -->
                    <div>
                        <label for="username" class="block text-gray-600 text-sm font-semibold mb-2">Nama Guru</label>
                        <input type="text" id="username" name="username" class="w-full px-4 py-2 rounded-lg shadow-sm border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-300 focus:outline-none transition duration-200 hover:shadow-md" placeholder="Masukkan Nama Guru" required>
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-gray-600 text-sm font-semibold mb-2">Password</label>
                        <input type="password" id="password" name="password" class="w-full px-4 py-2 rounded-lg shadow-sm border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-300 focus:outline-none transition duration-200 hover:shadow-md" placeholder="Masukkan Password" required>
                    </div>

                    <!-- Jenis Kelamin -->
                    <div>
                        <label for="jenisKelamin" class="block text-gray-600 text-sm font-semibold mb-2">Jenis Kelamin</label>
                        <select id="jenisKelamin" name="jenisKelamin" class="w-full px-4 py-2 rounded-lg shadow-sm border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-300 focus:outline-none transition duration-200 hover:shadow-md" required>
                            <option value="" disabled selected>Pilih Jenis Kelamin</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>

                    <!-- Tempat, Tanggal Lahir -->
                    <div>
                        <label for="tempatTglLahir" class="block text-gray-600 text-sm font-semibold mb-2">Tempat, Tanggal Lahir</label>
                        <input type="text" id="tempatTglLahir" name="tempatTglLahir" class="w-full px-4 py-2 rounded-lg shadow-sm border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-300 focus:outline-none transition duration-200 hover:shadow-md" placeholder="Masukkan Tempat dan Tanggal Lahir" required>
                    </div>


                    <!-- Alamat -->
                    <div>
                        <label for="alamat" class="block text-gray-600 text-sm font-semibold mb-2">Alamat</label>
                        <textarea id="alamat" name="alamat" class="w-full px-4 py-2 rounded-lg shadow-sm border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-300 focus:outline-none transition duration-200 hover:shadow-md" placeholder="Masukkan Alamat" rows="3" required></textarea>
                    </div>

                    <!-- No Telp -->
                    <div>
                        <label for="noTelp" class="block text-gray-600 text-sm font-semibold mb-2">No Telp</label>
                        <input type="tel" id="noTelp" name="noTelp" class="w-full px-4 py-2 rounded-lg shadow-sm border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-300 focus:outline-none transition duration-200 hover:shadow-md" placeholder="Masukkan No Telp" required>
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