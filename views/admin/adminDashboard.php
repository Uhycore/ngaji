<?php require_once 'service/auth.php'; ?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.4/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-gray-100 font-sans antialiased leading-normal tracking-normal h-full">
    <!-- Navbar -->
    <nav class="shadow-sm bg-white">
        <?php include 'views/includes/navbar.php'; ?>
    </nav>
    <!-- Layout Wrapper -->
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-48 bg-gray-200 min-h-full">
            <?php include 'views/includes/sidebar.php'; ?>
        </aside>

        <!-- Main Content -->
        <main class="flex-grow p-6">
            <h1 class="text-3xl font-bold text-gray-700 mb-6">Dashboard Admin</h1>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <!-- Data Cards -->
                <div class="bg-white p-4 rounded-lg shadow-md">
                    <div class="flex items-center">
                        <i class="fas fa-users text-blue-500 text-3xl mr-4"></i>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">Master Data Role</h3>
                            <p class="text-gray-600"><?php echo count($role); ?> Data</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-4 rounded-lg shadow-md">
                    <div class="flex items-center">
                        <i class="fas fa-user-cog text-green-500 text-3xl mr-4"></i>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">Data Admin</h3>
                            <p class="text-gray-600"><?php echo count($admin); ?> Data</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-4 rounded-lg shadow-md">
                    <div class="flex items-center">
                        <i class="fas fa-chalkboard-teacher text-green-500 text-3xl mr-4"></i>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">Data Guru</h3>
                            <p class="text-gray-600"><?php echo count($guru); ?> Data</p>
                        </div>
                    </div>
                </div>

                <!-- Additional Data Cards -->
                <div class="bg-white p-4 rounded-lg shadow-md">
                    <div class="flex items-center">
                        <i class="fas fa-user-graduate text-purple-500 text-3xl mr-4"></i>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">Data Santri</h3>
                            <p class="text-gray-600"><?php echo count($santri); ?> Data</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-4 rounded-lg shadow-md">
                    <div class="flex items-center">
                        <i class="fas fa-wallet text-red-500 text-3xl mr-4"></i>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">Data Bendahara</h3>
                            <p class="text-gray-600"><?php echo count($bendahara); ?> Data</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-4 rounded-lg shadow-md">
                    <div class="flex items-center">
                        <i class="fas fa-book text-yellow-500 text-3xl mr-4"></i>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">Data Mata Pelajaran</h3>
                            <p class="text-gray-600"><?php echo count($mapel); ?> Data</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-4 rounded-lg shadow-md">
                    <div class="flex items-center">
                        <i class="fas fa-school text-cyan-500 text-3xl mr-4"></i>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">Data Kelas</h3>
                            <p class="text-gray-600"><?php echo count($kelas); ?> Data</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Grafik Section -->
            <div class="mt-6">
                <h2 class="text-2xl font-bold text-gray-700 mb-3">Statistik Data</h2>

                <!-- Grafik Kiri dan Kanan -->
                <div class="flex flex-wrap gap-6 justify-between">
                    <!-- Bar Chart (Kiri) -->
                    <div class="bg-white p-4 rounded-lg shadow-md flex-grow w-full sm:w-auto">
                        <canvas id="barChart" class="h-32 w-full mx-auto"></canvas> <!-- Ukuran lebih kecil -->
                    </div>

                    <!-- Pie Chart (Kanan) -->
                    <div class="bg-white p-4 rounded-lg shadow-md w-full sm:w-1/2 lg:w-1/3">
                        <canvas id="pieChart" class="h-32 w-full mx-auto"></canvas> <!-- Ukuran lebih kecil -->
                    </div>
                </div>
            </div>




        </main>
    </div>

    <script>
        // Bar Chart (Jumlah Data per Kategori)
        var barChartContext = document.getElementById('barChart').getContext('2d');
        var barChart = new Chart(barChartContext, {
            type: 'bar',
            data: {
                labels: ['Role', 'Admin', 'Guru', 'Santri', 'Bendahara', 'Mata Pelajaran', 'Kelas'],
                datasets: [{
                    label: 'Jumlah Data',
                    data: [<?php echo count($role); ?>, <?php echo count($admin); ?>, <?php echo count($guru); ?>, <?php echo count($santri); ?>, <?php echo count($bendahara); ?>, <?php echo count($mapel); ?>, <?php echo count($kelas); ?>],
                    backgroundColor: '#4CAF50',
                    borderColor: '#388E3C',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Pie Chart (Persentase Data)
        var pieChartContext = document.getElementById('pieChart').getContext('2d');
        var pieChart = new Chart(pieChartContext, {
            type: 'pie',
            data: {
                labels: ['Role', 'Admin', 'Guru', 'Santri', 'Bendahara', 'Mata Pelajaran', 'Kelas'],
                datasets: [{
                    data: [<?php echo count($role); ?>, <?php echo count($admin); ?>, <?php echo count($guru); ?>, <?php echo count($santri); ?>, <?php echo count($bendahara); ?>, <?php echo count($mapel); ?>, <?php echo count($kelas); ?>],
                    backgroundColor: ['#FF5733', '#4CAF50', '#FFEB3B', '#2196F3', '#9C27B0', '#FF9800', '#795548']
                }]
            },
            options: {
                responsive: true
            }
        });
    </script>
</body>

</html>