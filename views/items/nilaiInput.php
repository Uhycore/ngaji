

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Nilai</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <!-- Navbar -->
    <?php include 'views/includes/navbar.php'; ?>

    <div class="flex">
     

        <div class="flex-1 p-8">
            <div class="container mx-auto">
                <h2 class="text-2xl font-semibold text-gray-900 mb-6">Input Nilai</h2>
                <form action="index.php?modul=nilai&fitur=add" method="POST" class="bg-white p-6 rounded-lg shadow-lg">
                    <div class="mb-4">
                        <label for="santriId" class="block text-gray-700">Santri</label>
                        <select name="santriId" id="santriId" class="w-full p-2 border border-gray-300 rounded mt-2">
                            <?php foreach ($santris as $santri) { ?>
                                <option value="<?php echo htmlspecialchars($santri->santriId); ?>"><?php echo htmlspecialchars($santri->username); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div id="nilai-inputs">
                        <div class="mb-4">
                            <label for="mapelId" class="block text-gray-700">Mata Pelajaran</label>
                            <select name="mapelId[]" class="w-full p-2 border border-gray-300 rounded mt-2">
                                <?php foreach ($mapels as $mapel) { ?>
                                    <option value="<?php echo htmlspecialchars($mapel->mapelId); ?>"><?php echo htmlspecialchars($mapel->mapelNama); ?></option>
                                <?php } ?>
                            </select>
                            <label for="nilai" class="block text-gray-700 mt-2">Nilai</label>
                            <input type="number" name="nilai[]" class="w-full p-2 border border-gray-300 rounded mt-2" required>
                        </div>
                    </div>
                    <button type="button" onclick="addMapelInput()" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">Tambah Mapel</button>
                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded mt-4">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function addMapelInput() {
            const container = document.createElement('div');
            container.classList.add('mb-4');
            container.innerHTML = `
                <label class="block text-gray-700">Mata Pelajaran</label>
                <select name="mapelId[]" class="w-full p-2 border border-gray-300 rounded mt-2">
                    <?php foreach ($mapels as $mapel) { ?>
                        <option value="<?php echo htmlspecialchars($mapel->mapelId); ?>"><?php echo htmlspecialchars($mapel->mapelNama); ?></option>
                    <?php } ?>
                </select>
                <label class="block text-gray-700 mt-2">Nilai</label>
                <input type="number" name="nilai[]" class="w-full p-2 border border-gray-300 rounded mt-2" required>`;
            document.getElementById('nilai-inputs').appendChild(container);
        }
    </script>
</body>

</html>