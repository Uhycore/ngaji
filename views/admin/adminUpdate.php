<?php require_once 'service/auth.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Admin</title>

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
            <!-- Formulir Update Admin -->
            <div class="max-w-lg mx-auto bg-gradient-to-br from-white to-gray-100 p-8 rounded-2xl shadow-xl transform hover:shadow-2xl transition-all duration-300">
                <h2 class="text-xl font-bold mb-6 text-gray-800 text-center" style="font-family: 'Poppins', sans-serif;">Update Data Admin</h2>
                <form action="index.php?modul=admin&fitur=update" method="POST" class="space-y-6">
                    <input type="hidden" id="adminId" name="adminId" value="<?php echo htmlspecialchars($objAdmin['adminId']); ?>">

                    <!-- Username -->
                    <div>
                        <label for="username" class="block text-gray-600 text-sm font-semibold mb-2">Username:</label>
                        <input type="text" id="username" name="username" class="shadow border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out hover:shadow-md"
                            placeholder="Masukkan Username" required value="<?php echo isset($objAdmin['username']) ? htmlspecialchars($objAdmin['username']) : ''; ?>">
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-gray-600 text-sm font-semibold mb-2">Password:</label>
                        <input type="password" id="password" name="password" class="shadow border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out hover:shadow-md"
                            placeholder="Masukkan Password" required value="<?php echo isset($objAdmin['password']) ? htmlspecialchars($objAdmin['password']) : ''; ?>">
                    </div>

                    <!-- Jenis Kelamin -->
                    <div>
                        <label for="adminJenisKelamin" class="block text-gray-600 text-sm font-semibold mb-2">Jenis Kelamin:</label>
                        <select id="adminJenisKelamin" name="adminJenisKelamin" class="shadow border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out hover:shadow-md" required>
                            <option value="Laki-laki" <?php echo (isset($objAdmin['adminJenisKelamin']) && $objAdmin['adminJenisKelamin'] == 'Laki-laki') ? 'selected' : ''; ?>>Laki-laki</option>
                            <option value="Perempuan" <?php echo (isset($objAdmin['adminJenisKelamin']) && $objAdmin['adminJenisKelamin'] == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
                        </select>
                    </div>

                    <!-- Alamat -->
                    <div>
                        <label for="adminAlamat" class="block text-gray-600 text-sm font-semibold mb-2">Alamat:</label>
                        <input type="text" id="adminAlamat" name="adminAlamat" class="shadow border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out hover:shadow-md"
                            placeholder="Masukkan Alamat" required value="<?php echo isset($objAdmin['adminAlamat']) ? htmlspecialchars($objAdmin['adminAlamat']) : ''; ?>">
                    </div>

                    <!-- Nomor Telepon -->
                    <div>
                        <label for="adminNoTelp" class="block text-gray-600 text-sm font-semibold mb-2">No. Telepon :</label>
                        <input type="tel" id="adminNoTelp" name="adminNoTelp" class="shadow border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out hover:shadow-md"
                            placeholder="Masukkan No. Telepon " required value="<?php echo isset($objAdmin['adminNoTelp']) ? htmlspecialchars($objAdmin['adminNoTelp']) : ''; ?>">
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-center">
                        <button type="submit" class="bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-indigo-600 hover:to-blue-500 text-white font-semibold py-2 px-6 rounded-lg shadow-lg transition-all duration-300 hover:shadow-2xl transform hover:scale-105">
                            Update Admin
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>