<?php require_once 'service/auth.php'; ?>
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
                <h2 class="text-xl font-bold mb-6 text-gray-800 text-center" style="font-family: 'Poppins', sans-serif;">Input Roles</h2>
                <form action="index.php?modul=role&fitur=add" method="POST" class="space-y-6">
                    <!-- Nama Role -->
                    <div>
                        <label for="roleNama" class="block text-gray-600 text-sm font-semibold mb-2">Nama Role</label>
                        <input type="text" id="roleNama" name="roleNama" class="w-full px-4 py-2 rounded-lg shadow-sm border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-300 focus:outline-none transition duration-200 hover:shadow-md"
                            placeholder="Masukkan Nama Role" required>
                    </div>

                    <!-- Role Deskripsi -->
                    <div>
                        <label for="roleDeskripsi" class="block text-gray-600 text-sm font-semibold mb-2">Role Deskripsi</label>
                        <textarea id="roleDeskripsi" name="roleDeskripsi" class="w-full px-4 py-2 rounded-lg shadow-sm border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-300 focus:outline-none transition duration-200 hover:shadow-md"
                            placeholder="Masukkan Deskripsi Role" rows="3" required></textarea>
                    </div>

                    <!-- Role Status -->
                    <div>
                        <label for="roleStatus" class="block text-gray-600 text-sm font-semibold mb-2">Role Status</label>
                        <select id="roleStatus" name="roleStatus" class="w-full px-4 py-2 rounded-lg shadow-sm border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-300 focus:outline-none transition duration-200 hover:shadow-md" required>
                            <option value="" disabled selected>Pilih Status</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
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