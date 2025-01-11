<?php require_once 'service/auth.php'; ?>
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
            <div class="flex flex-col items-start">
                <img src="assets/profil.jpg" alt="Profile Photo" class="w-28 h-28 rounded-full mb-4 border-4 border-cyan-500 transition-transform transform hover:scale-110">
                <h1 class="text-3xl font-semibold text-gray-800">
                    <?php echo htmlspecialchars($guru['username']); ?>
                </h1>
            </div>
        </div>

        <!-- Sidebar (Desktop) -->
        <aside class="bg-gray-50 col-span-1 h-full sticky top-0 hidden md:flex flex-col items-center border-r border-gray-200">
            <!-- Profile Image with Hover Effect -->
            <img src="assets/profil.jpg" alt="Profile Photo" class="w-32 h-32 rounded-full mb-8 border-4 border-cyan-500 transition-transform transform hover:scale-110" title="Profile Image">

            <!-- Profile Name with Modern Typography -->
            <div class="w-full px-8 py-4 text-center">
                <h1 class="text-xl font-semibold text-gray-800 hover:text-cyan-600 transition-colors duration-200" title="Username">
                    <?php echo htmlspecialchars($guru['username']); ?>
                </h1>
            </div>
        </aside>




        <!-- Main Content -->
        <main class="col-span-7 h-full flex flex-col">
            <div class="bg-gradient-to-r from-green-300 to-green-400 p-6">
                <p class="text-3xl font-semibold text-white">Profil Guru</p>
            </div>

            <section class="bg-gray-50 p-6 flex-grow space-y-6">
                <!-- Section Title -->
                <div class="bg-gradient-to-r from-green-400 to-green-500 p-4 rounded-lg shadow-md mb-6">
                    <h1 class="text-3xl font-semibold text-white">Data Guru</h1>
                </div>

                <!-- Gender -->
                <div class="grid grid-cols-7 gap-4 p-4 border border-gray-200 rounded-lg shadow-sm hover:shadow-lg transition-shadow">
                    <div class="text-right col-span-2">
                        <span class="font-semibold text-gray-700">Jenis Kelamin</span>
                    </div>
                    <div class="text-left pl-4 col-span-5">
                        <span class="text-gray-800"><?php echo htmlspecialchars($guru['guruJenisKelamin']); ?></span>
                    </div>
                </div>

                <!-- Birthplace & Date of Birth -->
                <div class="grid grid-cols-7 gap-4 p-4 border border-gray-200 rounded-lg shadow-sm hover:shadow-lg transition-shadow">
                    <div class="text-right col-span-2">
                        <span class="font-semibold text-gray-700">Tempat & Tanggal Lahir</span>
                    </div>
                    <div class="text-left pl-4 col-span-5">
                        <span class="text-gray-800"><?php echo htmlspecialchars($guru['guruTempatTglLahir']); ?></span>
                    </div>
                </div>

                <!-- Class -->
                <div class="grid grid-cols-7 gap-4 p-4 border border-gray-200 rounded-lg shadow-sm hover:shadow-lg transition-shadow">
                    <div class="text-right col-span-2">
                        <span class="font-semibold text-gray-700">Kelas</span>
                    </div>
                    <div class="text-left pl-4 col-span-5">
                        <span class="text-gray-800"><?php echo htmlspecialchars($kelas['namaKelas']); ?></span>
                    </div>
                </div>

                <!-- Address -->
                <div class="grid grid-cols-7 gap-4 p-4 border border-gray-200 rounded-lg shadow-sm hover:shadow-lg transition-shadow">
                    <div class="text-right col-span-2">
                        <span class="font-semibold text-gray-700">Alamat</span>
                    </div>
                    <div class="text-left pl-4 col-span-5">
                        <span class="text-gray-800"><?php echo htmlspecialchars($guru['guruAlamat']); ?></span>
                    </div>
                </div>

                <!-- Phone Number -->
                <div class="grid grid-cols-7 gap-4 p-4 border border-gray-200 rounded-lg shadow-sm hover:shadow-lg transition-shadow">
                    <div class="text-right col-span-2">
                        <span class="font-semibold text-gray-700">No. Telp</span>
                    </div>
                    <div class="text-left pl-4 col-span-5">
                        <span class="text-gray-800"><?php echo htmlspecialchars($guru['guruNoTelp']); ?></span>
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