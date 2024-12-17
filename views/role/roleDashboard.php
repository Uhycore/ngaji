<?php
echo "<pre>";
print_r($_SESSION['username_login']);
echo "</pre>";
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 font-sans antialiased leading-normal tracking-normal h-full">
    <!-- Navbar -->
    <nav class="shadow-sm bg-white mb-1">
        <?php include 'views/includes/navbar.php'; ?>
    </nav>
    <div class="flex flex-col items-center justify-center min-h-screen">
        <!-- Logo and Description -->
        <div class="flex flex-col items-center mb-8">
            <img src="assets/profil.jpg" alt="Lingkaran Logo" class="w-32 h-32 rounded-full object-cover mb-4">
            <p class="text-center text-lg font-semibold">Mabok bersama di TPQ Al-Qohol</p>
        </div>

        <!-- Feature Grid -->
        <div class="grid grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 justify-center">

            <!-- Role List -->
            <a href="index.php?modul=role&fitur=list">
                <div class="flex flex-col items-center justify-center">
                    <div class="w-16 h-16 bg-blue-400 rounded-full flex items-center justify-center text-white text-2xl font-bold shadow-lg hover:bg-green-400 transform hover:scale-110 transition-all duration-200">
                        <i class="fas fa-users-cog"></i>
                    </div>
                    <p class="mt-2 text-sm font-medium text-gray-700">List Role</p>
                </div>
            </a>

            <!-- Role Add -->
            <a href="index.php?modul=role&fitur=input">
                <div class="flex flex-col items-center justify-center">
                    <div class="w-16 h-16 bg-blue-400 rounded-full flex items-center justify-center text-white text-2xl font-bold shadow-lg hover:bg-green-400 transform hover:scale-110 transition-all duration-200">
                        <i class="fas fa-user-tag"></i>
                    </div>
                    <p class="mt-2 text-sm font-medium text-gray-700">Add Role</p>
                </div>
            </a>

            <!-- Admin List -->
            <a href="index.php?modul=admin&fitur=list">
                <div class="flex flex-col items-center justify-center">
                    <div class="w-16 h-16 bg-blue-400 rounded-full flex items-center justify-center text-white text-2xl font-bold shadow-lg hover:bg-green-400 transform hover:scale-110 transition-all duration-200">
                        <i class="fas fa-users"></i>
                    </div>
                    <p class="mt-2 text-sm font-medium text-gray-700">List Admin</p>
                </div>
            </a>

            <!-- Admin Add -->
            <a href="index.php?modul=admin&fitur=input">
                <div class="flex flex-col items-center justify-center">
                    <div class="w-16 h-16 bg-blue-400 rounded-full flex items-center justify-center text-white text-2xl font-bold shadow-lg hover:bg-green-400 transform hover:scale-110 transition-all duration-200">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <p class="mt-2 text-sm font-medium text-gray-700">Add Admin</p>
                </div>
            </a>

            <!-- Santri List -->
            <a href="index.php?modul=santri&fitur=list">
                <div class="flex flex-col items-center justify-center">
                    <div class="w-16 h-16 bg-blue-400 rounded-full flex items-center justify-center text-white text-2xl font-bold shadow-lg hover:bg-green-400 transform hover:scale-110 transition-all duration-200">
                        <i class="fas fa-users"></i>
                    </div>
                    <p class="mt-2 text-sm font-medium text-gray-500">List Santri</p>
                </div>
            </a>

            <!-- Santri Add -->
            <a href="index.php?modul=santri&fitur=input">
                <div class="flex flex-col items-center justify-center">
                    <div class="w-16 h-16 bg-blue-400 rounded-full flex items-center justify-center text-white text-2xl font-bold shadow-lg hover:bg-green-400 transform hover:scale-110 transition-all duration-200">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <p class="mt-2 text-sm font-medium text-gray-500">Add Santri</p>
                </div>
            </a>

            <!-- Guru List -->
            <a href="index.php?modul=guru&fitur=list">
                <div class="flex flex-col items-center justify-center">
                    <div class="w-16 h-16 bg-blue-400 rounded-full flex items-center justify-center text-white text-2xl font-bold shadow-lg hover:bg-green-400 transform hover:scale-110 transition-all duration-200">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <p class="mt-2 text-sm font-medium text-gray-500">List Guru</p>
                </div>
            </a>

            <!-- Guru Add -->
            <a href="index.php?modul=guru&fitur=input">
                <div class="flex flex-col items-center justify-center">
                    <div class="w-16 h-16 bg-blue-400 rounded-full flex items-center justify-center text-white text-2xl font-bold shadow-lg hover:bg-green-400 transform hover:scale-110 transition-all duration-200">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <p class="mt-2 text-sm font-medium text-gray-500">Add Guru</p>
                </div>
            </a>
            <!-- Guru List -->
            <a href="index.php?modul=bendahara&fitur=list">
                <div class="flex flex-col items-center justify-center">
                    <div class="w-16 h-16 bg-blue-400 rounded-full flex items-center justify-center text-white text-2xl font-bold shadow-lg hover:bg-green-400 transform hover:scale-110 transition-all duration-200">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <p class="mt-2 text-sm font-medium text-gray-500">List bendahara</p>
                </div>
            </a>

            <!-- bendahara Add -->
            <a href="index.php?modul=bendahara&fitur=input">
                <div class="flex flex-col items-center justify-center">
                    <div class="w-16 h-16 bg-blue-400 rounded-full flex items-center justify-center text-white text-2xl font-bold shadow-lg hover:bg-green-400 transform hover:scale-110 transition-all duration-200">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <p class="mt-2 text-sm font-medium text-gray-500">Add bendahara</p>
                </div>
            </a>
            <!-- Mapel List -->
            <a href="index.php?modul=mapel&fitur=list">
                <div class="flex flex-col items-center justify-center">
                    <div class="w-16 h-16 bg-blue-400 rounded-full flex items-center justify-center text-white text-2xl font-bold shadow-lg hover:bg-green-400 transform hover:scale-110 transition-all duration-200">
                        <i class="fas fa-book"></i>
                    </div>
                    <p class="mt-2 text-sm font-medium text-gray-500">List Mapel</p>
                </div>
            </a>

            <!-- Mapel Add -->
            <a href="index.php?modul=mapel&fitur=input">
                <div class="flex flex-col items-center justify-center">
                    <div class="w-16 h-16 bg-blue-400 rounded-full flex items-center justify-center text-white text-2xl font-bold shadow-lg hover:bg-green-400 transform hover:scale-110 transition-all duration-200">
                        <i class="fas fa-book-medical"></i>
                    </div>
                    <p class="mt-2 text-sm font-medium text-gray-500">Add Mapel</p>
                </div>
            </a>
            <!-- Rombel List -->
            <a href="index.php?modul=rombonganBelajar&fitur=list">
                <div class="flex flex-col items-center justify-center">
                    <div class="w-16 h-16 bg-blue-400 rounded-full flex items-center justify-center text-white text-2xl font-bold shadow-lg hover:bg-green-400 transform hover:scale-110 transition-all duration-200">
                        <i class="fas fa-book"></i>
                    </div>
                    <p class="mt-2 text-sm font-medium text-gray-500">List Rombel</p>
                </div>
            </a>

            <!-- Rombel Add -->
            <a href="index.php?modul=rombonganBelajar&fitur=input">
                <div class="flex flex-col items-center justify-center">
                    <div class="w-16 h-16 bg-blue-400 rounded-full flex items-center justify-center text-white text-2xl font-bold shadow-lg hover:bg-green-400 transform hover:scale-110 transition-all duration-200">
                        <i class="fas fa-book-medical"></i>
                    </div>
                    <p class="mt-2 text-sm font-medium text-gray-500">Add Rombel</p>
                </div>
            </a>

            <!-- Santri Nilai -->
            <a href="index.php?modul=nilai&fitur=list">
                <div class="flex flex-col items-center justify-center">
                    <div class="w-16 h-16 bg-blue-400 rounded-full flex items-center justify-center text-white text-2xl font-bold shadow-lg hover:bg-green-400 transform hover:scale-110 transition-all duration-200">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <p class="mt-2 text-sm font-medium text-gray-500">Nilai Santri</p>
                </div>
            </a>

            <!-- Santri Add Nilai -->
            <a href="index.php?modul=nilai&fitur=input">
                <div class="flex flex-col items-center justify-center">
                    <div class="w-16 h-16 bg-blue-400 rounded-full flex items-center justify-center text-white text-2xl font-bold shadow-lg hover:bg-green-400 transform hover:scale-110 transition-all duration-200">
                        <i class="fas fa-clipboard-list"></i>
                    </div>
                    <p class="mt-2 text-sm font-medium text-gray-500">Add Nilai Santri</p>
                </div>
            </a>


            <!-- Keuangan List -->
            <a href="index.php?modul=keuangan&fitur=list">
                <div class="flex flex-col items-center justify-center">
                    <div class="w-16 h-16 bg-blue-400 rounded-full flex items-center justify-center text-white text-2xl font-bold shadow-lg hover:bg-green-400 transform hover:scale-110 transition-all duration-200">
                        <i class="fas fa-coins"></i>
                    </div>
                    <p class="mt-2 text-sm font-medium text-gray-500">List Keuangan</p>
                    <p class="mt-2 text-sm font-medium text-gray-500">Santri</p>
                </div>
            </a>

            <!-- Keuangan Add -->
            <a href="index.php?modul=keuangan&fitur=input">
                <div class="flex flex-col items-center justify-center">
                    <div class="w-16 h-16 bg-blue-400 rounded-full flex items-center justify-center text-white text-2xl font-bold shadow-lg hover:bg-green-400 transform hover:scale-110 transition-all duration-200">
                        <i class="fas fa-hand-holding-usd"></i>
                    </div>
                    <p class="mt-2 text-sm font-medium text-gray-500">Add Keuangan</p>
                    <p class="mt-2 text-sm font-medium text-gray-500">Santri</p>
                </div>
            </a>
        </div>

    </div>

</body>

</html>