<?php require_once 'service/auth.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Santri</title>

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
            <!-- Formulir Update Santri -->
            <div class="max-w-lg mx-auto bg-gradient-to-br from-white to-gray-100 p-8 rounded-2xl shadow-xl transform hover:shadow-2xl transition-all duration-300">
                <h2 class="text-xl font-bold mb-6 text-gray-800 text-center" style="font-family: 'Poppins', sans-serif;">Update Data Santri</h2>
                <form action="index.php?modul=santri&fitur=update" method="POST" class="space-y-6">
                    <input type="hidden" id="santriId" name="santriId" value="<?php echo htmlspecialchars($objSantri['id']); ?>">

                    <!-- Username -->
                    <div>
                        <label for="username" class="block text-gray-600 text-sm font-semibold mb-2">Username:</label>
                        <input type="text" id="username" name="username" class="shadow border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out hover:shadow-md"
                            placeholder="Masukkan Username" required value="<?php echo isset($objSantri['username']) ? htmlspecialchars($objSantri['username']) : ''; ?>">
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-gray-600 text-sm font-semibold mb-2">Password:</label>
                        <input type="password" id="password" name="password" class="shadow border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out hover:shadow-md"
                            placeholder="Masukkan Password" required value="<?php echo isset($objSantri['password']) ? htmlspecialchars($objSantri['password']) : ''; ?>">
                    </div>

                    <!-- Jenis Kelamin -->
                    <div>
                        <label for="santriJenisKelamin" class="block text-gray-600 text-sm font-semibold mb-2">Jenis Kelamin:</label>
                        <select id="santriJenisKelamin" name="santriJenisKelamin" class="shadow border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out hover:shadow-md" required>
                            <option value="Laki-laki" <?php echo (isset($objSantri['santriJenisKelamin']) && $objSantri['santriJenisKelamin'] == 'Laki-laki') ? 'selected' : ''; ?>>Laki-laki</option>
                            <option value="Perempuan" <?php echo (isset($objSantri['santriJenisKelamin']) && $objSantri['santriJenisKelamin'] == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
                        </select>
                    </div>

                    <!-- Tempat Tanggal Lahir -->
                    <div>
                        <label for="santriTempatTglLahir" class="block text-gray-600 text-sm font-semibold mb-2">Tempat Tanggal Lahir:</label>
                        <input type="text" id="santriTempatTglLahir" name="santriTempatTglLahir" class="shadow border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out hover:shadow-md"
                            placeholder="Masukkan Tempat Tanggal Lahir" required value="<?php echo isset($objSantri['santriTempatTglLahir']) ? htmlspecialchars($objSantri['santriTempatTglLahir']) : ''; ?>">
                    </div>

                    <!-- Alamat -->
                    <div>
                        <label for="santriAlamat" class="block text-gray-600 text-sm font-semibold mb-2">Alamat:</label>
                        <input type="text" id="santriAlamat" name="santriAlamat" class="shadow border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out hover:shadow-md"
                            placeholder="Masukkan Alamat" required value="<?php echo isset($objSantri['santriAlamat']) ? htmlspecialchars($objSantri['santriAlamat']) : ''; ?>">
                    </div>

                    <!-- Nama Orang Tua -->
                    <div>
                        <label for="santriNamaOrtu" class="block text-gray-600 text-sm font-semibold mb-2">Nama Orang Tua:</label>
                        <input type="text" id="santriNamaOrtu" name="santriNamaOrtu" class="shadow border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out hover:shadow-md"
                            placeholder="Masukkan Nama Orang Tua" required value="<?php echo isset($objSantri['santriNamaOrtu']) ? htmlspecialchars($objSantri['santriNamaOrtu']) : ''; ?>">
                    </div>

                    <!-- Nomor Telepon Orang Tua -->
                    <div>
                        <label for="santriNoTelpOrtu" class="block text-gray-600 text-sm font-semibold mb-2">No. Telepon Orang Tua:</label>
                        <input type="text" id="santriNoTelpOrtu" name="santriNoTelpOrtu" class="shadow border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out hover:shadow-md"
                            placeholder="Masukkan No. Telepon Orang Tua" required value="<?php echo isset($objSantri['santriNoTelpOrtu']) ? htmlspecialchars($objSantri['santriNoTelpOrtu']) : ''; ?>">
                    </div>

                    <!-- Gaji Orang Tua -->
                    <div>
                        <label for="santriGajiOrtu" class="block text-gray-600 text-sm font-semibold mb-2">Gaji Orang Tua:</label>
                        <input type="text" id="santriGajiOrtu" name="santriGajiOrtu" class="shadow border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out hover:shadow-md"
                            placeholder="Masukkan Gaji Orang Tua" required value="<?php echo isset($objSantri['santriGajiOrtu']) ? htmlspecialchars($objSantri['santriGajiOrtu']) : ''; ?>">
                    </div>
                    <!-- Kelas -->
                    <div>
                        <label for="idKelas" class="block text-gray-600 text-sm font-semibold mb-2">Kelas</label>
                        <select id="idKelas" name="idKelas" class="w-full px-4 py-2 rounded-lg shadow-sm border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-300 focus:outline-none transition duration-200 hover:shadow-md" required>

                            <?php foreach ($kelas as $kelasItem): ?>
                                <option value="<?= $kelasItem['id']; ?>" <?= (isset($santri['idKelas']) && $santri['idKelas'] == $kelasItem['id']) ? 'selected' : ''; ?>>
                                    <?= $kelasItem['namaKelas']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>


                    <!-- Submit Button -->
                    <div class="flex justify-center">
                        <button type="submit" class="bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-indigo-600 hover:to-blue-500 text-white font-semibold py-2 px-6 rounded-lg shadow-lg transition-all duration-300 hover:shadow-2xl transform hover:scale-105">
                            Update Santri
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>