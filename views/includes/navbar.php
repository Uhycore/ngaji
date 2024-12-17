<head>
    <!-- Tambahkan Google Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>


<body class="bg-gray-100 font-sans">
    <nav class="bg-white shadow-lg border-b border-gray-200">
        <div class="container mx-auto flex justify-between items-center py-4 px-6" style="font-family: 'Inter', sans-serif;">
            <!-- Logo / Nama Aplikasi -->
            <div class="flex items-center space-x-3">
                <!-- Ikon Home -->
                <a href="index.php?modul=null">
                    <i class="fas fa-home text-2xl text-blue-600 hover:text-blue-800 transition-all duration-300"></i>
                </a>

                <!-- Nama Aplikasi -->
                <div class="text-blue-600 font-semibold text-lg sm:text-xl tracking-wide">
                    Aplikasi
                </div>
            </div>

            <!-- Bagian Profil dan Navigasi -->
            <div class="flex items-center space-x-6 sm:space-x-4">
                <div class="relative">
                    <!-- Profil dengan Hover -->
                    <img src="assets/profil.jpg" alt="Profil" class="w-12 h-12 sm:w-16 sm:h-16 rounded-full border-2 border-blue-600 shadow-lg transition-transform transform hover:scale-110 hover:shadow-2xl object-cover">
                </div>

                <!-- Nama User dan Role (untuk tampilan besar) -->
                <div class="hidden sm:flex flex-col items-end text-gray-800 font-semibold text-sm sm:text-base">
                    <span><?php echo $_SESSION['username_login']['username']; ?></span>
                    <span class="text-gray-500 text-xs"><?php echo $_SESSION['username_login']['roleId']['roleNama']; ?></span>

                </div>

                <!-- Tombol Logout (untuk tampilan besar) -->
                <div class="hidden sm:block">
                    <a href="index.php?modul=logout">
                        <button class="bg-gradient-to-r from-green-400 to-green-500 text-white font-semibold py-2 px-6 rounded-full shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200">
                            Logout
                        </button>
                    </a>
                </div>

                <!-- Tombol untuk tampilan mobile -->
                <div class="sm:hidden relative">
                    <button class="bg-blue-600 text-white py-2 px-4 rounded-full text-xs sm:text-sm" id="toggleUserMenu">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div id="userMenu" class="hidden absolute right-0 mt-2 bg-white shadow-xl rounded-lg p-4 w-48 z-10">


                        <p class="font-semibold text-sm"><?php echo $_SESSION['username_login']['username']; ?></p>
                        <p class="text-sm text-gray-500"><?php echo $_SESSION['username_login']['roleId']['roleNama']; ?></p>

                        <a href="index.php?modul=logout" class="block mt-2 text-green-500 hover:text-green-600 transition-all duration-200">
                            Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <script>
        // Toggle untuk menampilkan dan menyembunyikan menu user pada mobile
        const toggleButton = document.getElementById("toggleUserMenu");
        const userMenu = document.getElementById("userMenu");

        toggleButton.addEventListener("click", () => {
            userMenu.classList.toggle("hidden");
        });
    </script>
</body>