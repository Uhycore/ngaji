<div class="w-48 h-screen bg-gray-800 text-gray-200 shadow-lg">
    <div class="p-6 font-semibold text-lg text-white border-b border-gray-700">
        Menu
    </div>
    <ul class="mt-4 space-y-2">
        <li class="group">
            <a href="index.php?modul=role" class="flex items-center px-4 py-3 text-sm transition duration-300 ease-in-out hover:bg-gray-700 hover:text-blue-400 rounded-md transform hover:scale-105">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-3 text-blue-400 group-hover:text-blue-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <span>Master Data Role</span>
            </a>
        </li>
        <li class="group">
            <a href="index.php?modul=user" class="flex items-center px-4 py-3 text-sm transition duration-300 ease-in-out hover:bg-gray-700 hover:text-green-400 rounded-md transform hover:scale-105">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-3 text-green-400 group-hover:text-green-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9 5-9-5 9 5z" />
                </svg>
                <span>Master Data User</span>
            </a>
        </li>
        <li class="group">
            <a href="index.php?modul=barang" class="flex items-center px-4 py-3 text-sm transition duration-300 ease-in-out hover:bg-gray-700 hover:text-purple-400 rounded-md transform hover:scale-105">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-3 text-purple-400 group-hover:text-purple-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12H8m0 0l4-4m-4 4l4 4" />
                </svg>
                <span>Data Barang</span>
            </a>
        </li>
        <li class="group">
            <div class="flex items-center px-4 py-3 text-sm transition duration-300 ease-in-out hover:bg-gray-700 hover:text-yellow-400 cursor-pointer rounded-md transform hover:scale-105">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-3 text-yellow-400 group-hover:text-yellow-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <span>Menu Transaksi</span>
            </div>
            <!-- Submenu untuk Transaksi -->
            <ul class="ml-8 mt-2 space-y-1 hidden group-hover:block transition-all duration-300">
                <li>
                    <a href="index.php?modul=transaksi&fitur=input" class="block px-4 py-2 text-sm hover:bg-gray-700 hover:text-gray-300 transition duration-200 rounded transform hover:scale-105">
                        Insert Transaksi
                    </a>
                </li>
                <li>
                    <a href="index.php?modul=transaksi" class="block px-4 py-2 text-sm hover:bg-gray-700 hover:text-gray-300 transition duration-200 rounded transform hover:scale-105">
                        List Transaksi
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</div>