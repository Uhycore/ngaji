<head>
    <!-- Tambahkan Google Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <nav class="bg-white shadow-xl">
        <div class="container mx-auto flex justify-between items-center py-4 px-8" style="font-family: 'Inter', sans-serif;">
            <!-- Logo / Nama Aplikasi -->
            <div class="flex items-center space-x-3">
                <!-- Ikon Home -->

                <a href="index.php?modul=null">
                    <i class="fas fa-home text-2xl text-blue-600 transition-transform transform hover:scale-110"></i>
                </a>

                <!-- Nama Aplikasi -->
                <div class="text-blue-600 font-bold text-2xl tracking-wide">
                    Aplikasi
                </div>
            </div>


            <!-- Bagian Profil dan Navigasi -->
            <div class="flex items-center space-x-6">
                <div class="relative">
                    <!-- Profil dengan Hover -->
                    <img src="assets/profil.jpg" alt="Profil" class="w-12 h-12 rounded-full border-2 border-blue-600 shadow-lg hover:shadow-300 transition-transform transform hover:scale-110 hover:shadow-2xl object-cover">
                </div>

                <!-- Nama User -->
                <div class="text-gray-800 font-semibold text-sm">
                    <?php echo $_SESSION['username_login']->username; ?>
                </div>
                <!-- Nama role User -->
                <div class="text-gray-800 font-semibold text-sm">
                    <?php echo $_SESSION['username_login']->role->roleNama; ?>
                </div>

                <!-- Tombol Logout dengan animasi modern -->
                <a href="index.php?modul=logout">

                    <button class="bg-gradient-to-r from-green-200 to-green-300 hover:from-green-300 hover:to-green-200 text-white font-medium py-2 px-6 rounded-full transition-all duration-300 shadow-lg hover:shadow-2xl transform hover:scale-105">
                        Logout
                    </button>
                </a>
            </div>
        </div>
    </nav>
</body>