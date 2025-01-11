<?php require_once 'service/auth.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Absensi</title>

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
            <!-- Formulir Input Absensi -->
            <div class="max-w-md mx-auto bg-gradient-to-br from-white to-gray-100 p-8 rounded-2xl shadow-xl">
                <h2 class="text-xl font-bold mb-6 text-gray-800 text-center" style="font-family: 'Poppins', sans-serif;">Input Absensi</h2>
                <form action="index.php?modul=absen&fitur=add" method="POST" class="space-y-6">
                    <!-- Tanggal -->
                    <div>
                        <label for="tanggal" class="block text-gray-600 text-sm font-semibold mb-2">Tanggal</label>
                        <input type="date" id="tanggal" name="tanggal" class="w-full px-4 py-2 rounded-lg shadow-sm border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-300 focus:outline-none transition duration-200 hover:shadow-md" required>
                    </div>

                    <!-- Daftar Santri -->
                    <div>
                        <label class="block text-gray-600 text-sm font-semibold mb-2">Daftar Santri</label>
                        <div class="border border-gray-300 rounded-lg shadow-sm p-4 space-y-2">
                            <?php foreach ($hasil as $santri): ?>
                                <div class="flex items-center">
                                    <input type="checkbox" id="santri-<?php echo htmlspecialchars($santri['id']); ?>" name="idSantri[]" value="<?php echo htmlspecialchars($santri['id']); ?>" class="mr-3">
                                    <label for="santri-<?php echo htmlspecialchars($santri['id']); ?>" class="text-gray-700">
                                        <?php echo htmlspecialchars($santri['username']); ?>
                                    </label>
                                </div>
                            <?php endforeach; ?>
                        </div>
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