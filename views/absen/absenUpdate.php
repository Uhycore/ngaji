<?php require_once 'service/auth.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Absensi</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <!-- Navbar -->
    <?php include 'views/includes/navbar.php'; ?>

   
    <!-- Main container -->
    <div class="flex justify-center py-12">
        <!-- Main Content -->
        <div class="w-full sm:w-96 bg-gradient-to-br from-white to-gray-100 p-8 rounded-2xl shadow-xl">
            <!-- Formulir Update Absensi -->
            <h2 class="text-xl font-bold mb-6 text-gray-800 text-center" style="font-family: 'Poppins', sans-serif;">Update Absensi idnya : "<?php echo htmlspecialchars($absen->id); ?>"</h2>
            <form action="absenUpdate.php?id=<?php echo $absenId; ?>" method="POST" class="space-y-6">
                <!-- Tanggal -->
                <div>
                    <label for="tanggal" class="block text-gray-600 text-sm font-semibold mb-2">Tanggal</label>
                    <input type="date" id="tanggal" name="tanggal" class="w-full px-4 py-2 rounded-lg shadow-sm border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-300 focus:outline-none transition duration-200 hover:shadow-md" value="<?php echo htmlspecialchars($absen->tanggal); ?>" required>
                </div>

                <!-- Daftar Santri -->
                <div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-800 text-xl font-medium">
                            Santri: <?php echo htmlspecialchars($absen->idSantri['username']); ?>
                        </span>
                    </div>
                </div>



                <!-- Submit Button -->
                <div class="flex justify-center mt-6">
                    <button type="submit" class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold py-2 px-6 rounded-full transition duration-300 shadow-lg hover:shadow-2xl transform hover:scale-105">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>

</html>