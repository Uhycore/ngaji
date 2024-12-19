<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Guru</title>

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
            <!-- Formulir Update Guru -->
            <div class="max-w-lg mx-auto bg-gradient-to-br from-white to-gray-100 p-8 rounded-2xl shadow-xl transform hover:shadow-2xl transition-all duration-300">
                <h2 class="text-xl font-bold mb-6 text-gray-800 text-center" style="font-family: 'Poppins', sans-serif;">Update Data Guru</h2>
                <form action="index.php?modul=guru&fitur=update" method="POST" class="space-y-6">
                    <!-- Hidden input untuk ID Guru -->
                    <input type="hidden" id="guruId" name="guruId" value="<?php echo htmlspecialchars($objGuru['id']); ?>">

                    <!-- Username -->
                    <div>
                        <label for="username" class="block text-gray-600 text-sm font-semibold mb-2">Username:</label>
                        <input type="text" id="username" name="username" class="shadow border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out hover:shadow-md"
                            placeholder="Masukkan Username" required value="<?php echo isset($objGuru['username']) ? htmlspecialchars($objGuru['username']) : ''; ?>">
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-gray-600 text-sm font-semibold mb-2">Password:</label>
                        <input type="password" id="password" name="password" class="shadow border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out hover:shadow-md"
                            placeholder="Masukkan Password" required value="<?php echo isset($objGuru['password']) ? htmlspecialchars($objGuru['password']) : ''; ?>">
                    </div>

                    <!-- Jenis Kelamin -->
                    <div>
                        <label for="jenisKelamin" class="block text-gray-600 text-sm font-semibold mb-2">Jenis Kelamin:</label>
                        <select id="jenisKelamin" name="jenisKelamin" class="shadow border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out hover:shadow-md" required>
                            <option value="Laki-laki" <?php echo (isset($objGuru['jenisKelamin']) && $objGuru['jenisKelamin'] == 'Laki-laki') ? 'selected' : ''; ?>>Laki-laki</option>
                            <option value="Perempuan" <?php echo (isset($objGuru['jenisKelamin']) && $objGuru['jenisKelamin'] == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
                        </select>
                    </div>

                    <!-- Tempat dan Tanggal Lahir -->
                    <div>
                        <label for="tempatTglLahir" class="block text-gray-600 text-sm font-semibold mb-2">Tempat dan Tanggal Lahir:</label>
                        <input type="text" id="tempatTglLahir" name="tempatTglLahir" class="shadow border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out hover:shadow-md"
                            placeholder="Masukkan Tempat dan Tanggal Lahir" required value="<?php echo isset($objGuru['guruTempatTglLahir']) ? htmlspecialchars($objGuru['guruTempatTglLahir']) : ''; ?>">
                    </div>

                    <!-- Alamat -->
                    <div>
                        <label for="alamat" class="block text-gray-600 text-sm font-semibold mb-2">Alamat:</label>
                        <input type="text" id="alamat" name="alamat" class="shadow border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out hover:shadow-md"
                            placeholder="Masukkan Alamat" required value="<?php echo isset($objGuru['guruAlamat']) ? htmlspecialchars($objGuru['guruAlamat']) : ''; ?>">
                    </div>

                    <!-- Nomor Telepon -->
                    <div>
                        <label for="noTelp" class="block text-gray-600 text-sm font-semibold mb-2">No. Telepon :</label>
                        <input type="tel" id="noTelp" name="noTelp" class="shadow border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out hover:shadow-md"
                            placeholder="Masukkan No. Telepon" required value="<?php echo isset($objGuru['guruNoTelp']) ? htmlspecialchars($objGuru['guruNoTelp']) : ''; ?>">
                    </div>
                
                    <!-- Submit Button -->
                    <div class="flex justify-center">
                        <button type="submit" class="bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-indigo-600 hover:to-blue-500 text-white font-semibold py-2 px-6 rounded-lg shadow-lg transition-all duration-300 hover:shadow-2xl transform hover:scale-105">
                            Update Guru
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>