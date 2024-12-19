<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body class="font-sans text-gray-800 bg-gray-50">

    <!-- Navbar -->
    <nav class="bg-white shadow-xl">
        <?php include 'views/includes/navbar.php'; ?>
    </nav>

    <div class="grid md:grid-cols-8 grid-cols-1 min-h-screen">

        <!-- Profile Info (Mobile) -->
        <div class="p-6 flex flex-col items-start md:hidden space-y-4">
            <div class="flex flex-col items-center w-full">
                <!-- Profile Photo -->
                <img src="assets/profil.jpg" alt="Profile Photo" class="w-28 h-28 rounded-full mb-4 border-4 border-cyan-500 transition-transform transform hover:scale-105">

                <!-- Username -->
                <h1 class="text-3xl font-semibold text-gray-800">
                    <?php echo htmlspecialchars($santri['username']); ?>
                </h1>
            </div>
        </div>

        <!-- Sidebar (Desktop) -->
        <aside class="bg-gray-50 col-span-1 h-full sticky top-0 hidden md:flex flex-col items-center border-r border-gray-200">
            <!-- Profile Photo -->
            <img src="assets/profil.jpg" alt="Profile Photo" class="w-28 h-28 rounded-full mt-6 border-4 border-cyan-500 transition-transform transform hover:scale-105">

            <!-- Profile Info -->
            <div class="bg-gray-200 w-full p-4 text-center">
                <h1 class="text-2xl font-semibold text-gray-800">
                    <?php echo htmlspecialchars($santri['username']); ?>
                </h1>
            </div>
        </aside>


        <!-- Main Content -->
        <main class="col-span-7 h-full flex flex-col">
            <div class="bg-gradient-to-r from-green-300 to-green-400 p-6">
                <p class="text-3xl font-semibold text-white">Profil Santri</p>
            </div>

            <section class="bg-white p-6 flex-grow">
                <div class="bg-gradient-to-r from-green-300 to-green-400 p-4 rounded-lg mb-6 shadow-lg">
                    <h1 class="text-2xl font-semibold text-gray-800">Data Santri :</h1>
                </div>

                <!-- Kelas -->
                <div class="grid grid-cols-7 font-medium text-gray-700 mb-4 p-4 border border-gray-300 rounded-lg shadow-md">
                    <div class="text-right col-span-2">
                        <strong>Kelas</strong>
                    </div>
                    <div class="text-left pl-10 col-span-5">
                        <span><?php echo htmlspecialchars($santri['idKelas']['namaKelas']); ?></span>
                    </div>
                </div>
                <!-- Jenis Kelamin -->
                <div class="grid grid-cols-7 font-medium text-gray-700 mb-4 p-4 border border-gray-300 rounded-lg shadow-md">
                    <div class="text-right col-span-2">
                        <strong>Jenis Kelamin</strong>
                    </div>
                    <div class="text-left pl-10 col-span-5">
                        <span><?php echo htmlspecialchars($santri['santriJenisKelamin']); ?></span>
                    </div>
                </div>

                <!-- Tempat & Tanggal Lahir -->
                <div class="grid grid-cols-7 font-medium text-gray-700 mb-4 p-4 border border-gray-300 rounded-lg shadow-md">
                    <div class="text-right col-span-2">
                        <strong>Tempat & Tanggal Lahir</strong>
                    </div>
                    <div class="text-left pl-10 col-span-5">
                        <span><?php echo htmlspecialchars($santri['santriTempatTglLahir']); ?></span>
                    </div>
                </div>

                <!-- Alamat -->
                <div class="grid grid-cols-7 font-medium text-gray-700 mb-4 p-4 border border-gray-300 rounded-lg shadow-md">
                    <div class="text-right col-span-2">
                        <strong>Alamat</strong>
                    </div>
                    <div class="text-left pl-10 col-span-5">
                        <span><?php echo htmlspecialchars($santri['santriAlamat']); ?></span>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-green-300 to-green-400 p-4 rounded-lg mb-6 shadow-lg">
                    <h1 class="text-2xl font-semibold text-gray-800">Data Orang Tua :</h1>
                </div>

                <!-- Nama Orang Tua -->
                <div class="grid grid-cols-7 font-medium text-gray-700 mb-4 p-4 border border-gray-300 rounded-lg shadow-md">
                    <div class="text-right col-span-2">
                        <strong>Nama Orang Tua</strong>
                    </div>
                    <div class="text-left pl-10 col-span-5">
                        <span><?php echo htmlspecialchars($santri['santriNamaOrtu']); ?></span>
                    </div>
                </div>

                <!-- No Telepon Orang Tua -->
                <div class="grid grid-cols-7 font-medium text-gray-700 mb-4 p-4 border border-gray-300 rounded-lg shadow-md">
                    <div class="text-right col-span-2">
                        <strong>No Telepon Orang Tua</strong>
                    </div>
                    <div class="text-left pl-10 col-span-5">
                        <span><?php echo htmlspecialchars($santri['santriNoTelpOrtu']); ?></span>
                    </div>
                </div>

                <!-- Gaji Orang Tua -->
                <div class="grid grid-cols-7 font-medium text-gray-700 mb-4 p-4 border border-gray-300 rounded-lg shadow-md">
                    <div class="text-right col-span-2">
                        <strong>Gaji Orang Tua</strong>
                    </div>
                    <div class="text-left pl-10 col-span-5">
                        <span>Rp <?php echo number_format($santri['santriGajiOrtu'], 0, ',', '.'); ?></span>
                    </div>
                </div>
            </section>
        </main>

    </div>

    <!-- Footer -->
    <div class="border-t border-gray-200">
        <footer class="text-center text-gray-600 text-sm p-4 border-gray-200 bg-gray-50">
            <p>© 2023 Aril. All rights reserved.</p>
        </footer>
    </div>

</body>

</html>