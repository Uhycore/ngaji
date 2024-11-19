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

    <div class="flex justify-center items-center min-h-screen h-full">
        <!-- Logo Lingkaran -->
        <div class="grid grid-cols-3 gap-4 mb-8">



            <!-- Santri Nilai -->
            <a href="index.php?modul=asSantri&fitur=nilai">
                <div class="flex flex-col items-center justify-center">
                    <div class="w-16 h-16 bg-blue-400 rounded-full flex items-center justify-center text-white text-2xl font-bold shadow-lg hover:bg-green-400 transform hover:scale-110 transition-all duration-200">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <p class="mt-2 text-sm font-medium text-gray-500">Nilai</p>
                </div>
            </a>

            <!-- Keuangan List -->
            <a href="index.php?modul=asSantri&fitur=keuangan">
                <div class="flex flex-col items-center justify-center">
                    <div class="w-16 h-16 bg-blue-400 rounded-full flex items-center justify-center text-white text-2xl font-bold shadow-lg hover:bg-green-400 transform hover:scale-110 transition-all duration-200">
                        <i class="fas fa-coins"></i>
                    </div>
                    <p class="mt-2 text-sm font-medium text-gray-500">Keuangan</p>
                </div>
            </a>
            <!-- Profil -->
            <a href="index.php?modul=asSantri&fitur=profil">
                <div class="flex flex-col items-center justify-center">
                    <div class="w-16 h-16 bg-blue-400 rounded-full flex items-center justify-center text-white text-2xl font-bold shadow-lg hover:bg-green-400 transform hover:scale-110 transition-all duration-200">
                        <i class="fa-regular fa-user"></i>
                    </div>
                    <p class="mt-2 text-sm font-medium text-gray-500">Profil</p>
                </div>
            </a>


        </div>
    </div>

</body>

</html>