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

        <!-- Main Content -->
        <div class="flex-1 p-20">
            <!-- Formulir Input Role -->
            <div class="max-w-lg mx-auto bg-gradient-to-br from-white to-gray-100 p-8 rounded-2xl shadow-xl transform hover:shadow-2xl transition-all duration-300">
                <h2 class="text-xl font-bold mb-6 text-gray-800 text-center" style="font-family: 'Poppins', sans-serif;">Input Role</h2>
                <form action="index.php?modul=role&fitur=update" method="POST" class="space-y-6">
                    <input type="hidden" id="roleId" name="roleId" value="<?php echo htmlspecialchars($objRoles['roleId']); ?>">

                    <!-- Nama Role -->
                    <div>
                        <label for="roleNama" class="block text-gray-600 text-sm font-semibold mb-2">Nama Role:</label>
                        <input type="text" id="roleNama" name="roleNama" class="shadow border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out hover:shadow-md"
                            placeholder="Masukkan Nama Role" required value="<?php echo isset($objRoles['roleNama']) ? htmlspecialchars($objRoles['roleNama']) : ''; ?>">
                    </div>

                    <!-- Role Deskripsi -->
                    <div>
                        <label for="roleDeskripsi" class="block text-gray-600 text-sm font-semibold mb-2">Role Deskripsi:</label>
                        <textarea id="roleDeskripsi" name="roleDeskripsi" class="shadow border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out hover:shadow-md"
                            placeholder="Masukkan Deskripsi Role" rows="3" required><?php echo isset($objRoles['roleDeskripsi']) ? htmlspecialchars($objRoles['roleDeskripsi']) : ''; ?></textarea>
                    </div>

                    <!-- Role Status -->
                    <div>
                        <label for="roleStatus" class="block text-gray-600 text-sm font-semibold mb-2">Role Status:</label>
                        <select id="roleStatus" name="roleStatus" class="shadow border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out hover:shadow-md" required>
                            <option value="1" <?php echo isset($objRoles['roleStatus']) && $objRoles['roleStatus'] == 1 ? 'selected' : ''; ?>>Aktif</option>
                            <option value="0" <?php echo isset($objRoles['roleStatus']) && $objRoles['roleStatus'] == 0 ? 'selected' : ''; ?>>Tidak Aktif</option>
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