<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Keuangan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <?php include 'views/includes/navbar.php'; ?>

    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6">Input Data Keuangan</h1>
        <form action="index.php?modul=keuangan&fitur=add" method="POST" class="bg-white p-6 rounded-lg shadow-md">
            <div class="mb-4">
                <label for="santriId" class="block text-sm font-medium text-gray-700">Pilih Santri</label>
                <select id="santriId" name="santriId" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md">
                    <?php foreach ($santris as $santri): ?>
                        <option value="<?= $santri->santriId ?>"><?= $santri->username ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-4">
                <label for="detailKeuangan" class="block text-sm font-medium text-gray-700">Detail Keuangan</label>
                <div id="detailKeuangan">
                    <div class="mb-2">
                        <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal</label>
                        <input type="date" name="tanggal[]" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md" required>
                    </div>
                    <div class="mb-2">
                        <label for="nominal" class="block text-sm font-medium text-gray-700">Nominal</label>
                        <input type="number" name="nominal[]" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md" required>
                    </div>
                </div>
                <button type="button" onclick="addDetail()" class="mt-2 text-blue-500 hover:underline">Tambah Detail</button>
            </div>

            <div class="mt-6">
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700">Simpan</button>
                <a href="index.php?modul=keuangan" class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-700 ml-4">Kembali</a>
            </div>
        </form>

    </div>

    <script>
        function addDetail() {
            const detailKeuanganDiv = document.getElementById('detailKeuangan');
            const newDetail = document.createElement('div');
            newDetail.classList.add('mb-2');
            newDetail.innerHTML = `
                <label class="block text-sm font-medium text-gray-700">Tanggal</label>
                <input type="date" name="tanggal[]" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md" required>
                <label class="block text-sm font-medium text-gray-700">Nominal</label>
                <input type="number" name="nominal[]" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md" required>
            `;
            detailKeuanganDiv.appendChild(newDetail);
        }
    </script>

</body>

</html>