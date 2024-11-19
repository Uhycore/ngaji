<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Santri</title>

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
            <!-- Formulir Input Santri -->
            <div class="max-w-md mx-auto bg-gradient-to-br from-white to-gray-100 p-8 rounded-2xl shadow-xl">
                <h2 class="text-xl font-bold mb-6 text-gray-800 text-center" style="font-family: 'Poppins', sans-serif;">Input Santri</h2>
                <form action="index.php?modul=santri&fitur=add" method="POST" class="space-y-6">
                    <!-- Nama -->
                    <div>
                        <label for="username" class="block text-gray-600 text-sm font-semibold mb-2">Nama Santri</label>
                        <input type="text" id="username" name="username" class="w-full px-4 py-2 rounded-lg shadow-sm border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-300 focus:outline-none transition duration-200 hover:shadow-md" placeholder="Masukkan Nama Santri" required>
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-gray-600 text-sm font-semibold mb-2">Password</label>
                        <input type="password" id="password" name="password" class="w-full px-4 py-2 rounded-lg shadow-sm border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-300 focus:outline-none transition duration-200 hover:shadow-md" placeholder="Masukkan Password" required>
                    </div>

                    <!-- Jenis Kelamin -->
                    <div>
                        <label for="santriJenisKelamin" class="block text-gray-600 text-sm font-semibold mb-2">Jenis Kelamin</label>
                        <select id="santriJenisKelamin" name="santriJenisKelamin" class="w-full px-4 py-2 rounded-lg shadow-sm border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-300 focus:outline-none transition duration-200 hover:shadow-md" required>
                            <option value="" disabled selected>Pilih Jenis Kelamin</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>

                    <!-- Tempat, Tgl Lahir -->
                    <div>
                        <label for="santriTempatTglLahir" class="block text-gray-600 text-sm font-semibold mb-2">Tempat, Tgl Lahir</label>
                        <input type="text" id="santriTempatTglLahir" name="santriTempatTglLahir" class="w-full px-4 py-2 rounded-lg shadow-sm border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-300 focus:outline-none transition duration-200 hover:shadow-md" placeholder="Masukkan Tempat, Tgl Lahir" required>
                    </div>

                    <!-- Alamat -->
                    <div>
                        <label for="santriAlamat" class="block text-gray-600 text-sm font-semibold mb-2">Alamat</label>
                        <textarea id="santriAlamat" name="santriAlamat" class="w-full px-4 py-2 rounded-lg shadow-sm border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-300 focus:outline-none transition duration-200 hover:shadow-md" placeholder="Masukkan Alamat" rows="3" required></textarea>
                    </div>

                    <!-- Nama Ortu -->
                    <div>
                        <label for="santriNamaOrtu" class="block text-gray-600 text-sm font-semibold mb-2">Nama Orang Tua</label>
                        <input type="text" id="santriNamaOrtu" name="santriNamaOrtu" class="w-full px-4 py-2 rounded-lg shadow-sm border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-300 focus:outline-none transition duration-200 hover:shadow-md" placeholder="Masukkan Nama Orang Tua" required>
                    </div>

                    <!-- No Telp Ortu -->
                    <div>
                        <label for="santriNoTelpOrtu" class="block text-gray-600 text-sm font-semibold mb-2">No Telp Orang Tua</label>
                        <input type="tel" id="santriNoTelpOrtu" name="santriNoTelpOrtu" class="w-full px-4 py-2 rounded-lg shadow-sm border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-300 focus:outline-none transition duration-200 hover:shadow-md" placeholder="Masukkan No Telp Orang Tua" required>
                    </div>

                    <!-- Gaji Ortu -->
                    <div>
                        <label for="santriGajiOrtu" class="block text-gray-600 text-sm font-semibold mb-2">Gaji Orang Tua</label>
                        <input type="number" id="santriGajiOrtu" name="santriGajiOrtu" class="w-full px-4 py-2 rounded-lg shadow-sm border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-300 focus:outline-none transition duration-200 hover:shadow-md" placeholder="Masukkan Gaji Orang Tua" required>
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
