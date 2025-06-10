<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard Rekam Medis</title>
  <script src="https://cdn.tailwindcss.com"></script> 
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />


  <style>
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes slideIn {
            from { transform: translateX(-100%); }
            to { transform: translateX(0); }
        }
        .animate-fade-in {
            animation: fadeIn 0.5s ease-out forwards;
        }
        .animate-slide-in {
            animation: slideIn 0.5s ease-out forwards;
        }
        .menu-item-hover {
            position: relative;
            overflow: hidden;
        }
        .menu-item-hover::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: currentColor;
            transform: scaleX(0);
            transform-origin: right;
            transition: transform 0.3s ease-out;
        }
        .menu-item-hover:hover::after {
            transform: scaleX(1);
            transform-origin: left;
        }
    </style>

</head>

<body class="bg-gray-100 font-sans">

  <!-- Sidebar -->
  <div class="fixed top-0 left-0 h-full w-60 bg-[#a8dadc] px-4 py-6 shadow-lg">
    <div class="flex items-center space-x-2 mb-10">
      <img src="logopuskesmas.png" alt="Logo" class="w-20 h-20" />
      <div>
        <h1 class="text-xl font-bold text-black">CheckMyLab</h1>
        <p class="text-sm text-black leading-tight">UPT Puskesmas<br>Baloi Permai</p>
      </div>
    </div>

    <nav class="flex overflow-y-1">
            <ul class="p-4 space-y-2">
                <li class="animate-fade-in" style="animation-delay: 0.1s;">
                    <a href="menu-dashboard.html" class="flex items-center gap-4 p-2 text-gray-700 dark:text-gray-200 rounded-lg hover:bg-indigo-100 dark:hover:bg-indigo-900 transition-colors duration-300 menu-item-hover">
                        <i class="fas fa-home w-5 h-5"></i>
                        Beranda
                    </a>
                </li>
                <li class="animate-fade-in" style="animation-delay: 0.1s;">
                    <a href="menu-pasien.html" class="flex items-center gap-4 p-2 text-gray-700 dark:text-gray-200 rounded-lg hover:bg-indigo-100 dark:hover:bg-indigo-900 transition-colors duration-300 menu-item-hover">
                        <i class="fas fa-user w-5 h-5"></i>
                        Pasien
                    </a>
                </li>
                <li class="animate-fade-in" style="animation-delay: 0.2s;">
                    <a href="menu-pegawai.html" class="flex items-center gap-4 p-2 text-gray-700 dark:text-gray-200 rounded-lg hover:bg-indigo-100 dark:hover:bg-indigo-900 transition-colors duration-300 menu-item-hover">
                        <i class="fas fa-user-md w-5 h-5"></i>
                        Pegawai
                    </a>
                </li>
                <li class="animate-fade-in" style="animation-delay: 0.3s;">
                    <a href="menu-hasil-uji-lab.html" class="flex items-center gap-4 p-2 text-gray-700 dark:text-gray-200 rounded-lg hover:bg-indigo-100 dark:hover:bg-indigo-900 transition-colors duration-300 menu-item-hover">
                        <i class="fas fa-vial w-5 h-5"></i>
                        Hasil Uji Lab
                    </a>
                </li>
                <li class="animate-fade-in" style="animation-delay: 0.4s;">
                    <a href="menu-pengaturan-akun.html" class="flex items-center gap-4 p-2 text-gray-700 dark:text-gray-200 rounded-lg hover:bg-indigo-100 dark:hover:bg-indigo-900 transition-colors duration-300 menu-item-hover">
                        <i class="fas fa-cog w-5 h-5"></i>
                        Pengaturan Akun
                    </a>
                </li>
            </ul>
        </nav>
  </div>

  <!-- Main content area -->
  <div class="ml-60 min-h-screen">
    <!-- Navbar -->
    <header class="flex justify-end items-center bg-white shadow px-5 py-3">
      <div class="flex items-center gap-4">
          <div class="sm:flex sm:gap-4">
            <a href="landing-page.html"
            class="bg-[#a8dadc] hover:bg-[#7cbac0] text-black font-semibold px-4 py-2 rounded">
              Keluar
            </a>
    </header>

    <!-- Page Content -->
    <div class="flex items-center mt-2 ml-2 mr-2 mb-6">

  <main class="flex-1 bg-white p-6 overflow-y-auto">
    <!-- Header -->
    <div class="flex items-center space-x-4 mb-4">
<div class="relative ">
  <input type="text" placeholder="cari pasien" class="border rounded px-3 py-2 w-80 pl-10 " />
  <span class="absolute left-4 top-4"><i class="fas fa-search text-gray-400 flex items-center"></i></span>
</div>
  <button onclick="openModal()" class="bg-[#E0F7F8] text-black text-gray-500 rounded px-4 py-2">
    + Tambah Pasien
  </button>
</div>

<!-- Modal -->
<div id="modalPasien" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
  <div class="bg-white rounded shadow-lg w-full max-w-md p-6 relative">
    
    <!-- Tombol Close -->
    <button onclick="closeModal()" class="absolute top-2 right-3 text-gray-500 hover:text-black text-xl">
      &times;
    </button>

    <!-- Judul -->
    <h2 class="text-xl font-semibold text-center mb-4">Tambah Pasien</h2>

    <!-- Form Input -->
    <form id="formPasien" class="space-y-3">
      <input type="text" placeholder="No. ERM" class="w-full border rounded px-3 py-2" />
      <input type="text" placeholder="NIK" class="w-full border rounded px-3 py-2" />
      <input type="text" placeholder="Nama" class="w-full border rounded px-3 py-2" />
      <input type="date" placeholder="Tanggal Lahir" class="w-full border rounded px-3 py-2 text-gray-500" />
      <input type="text" placeholder="No. Telepon" class="w-full border rounded px-3 py-2" />

      <button type="submit" class="w-full bg-[#a8dadc] hover:bg-[#7cbac0] text-black py-2 rounded ">
        Tambahkan
      </button>
    </form>
  </div>
</div>


<script>
  function openModal() {
    document.getElementById("modalPasien").classList.remove("hidden");
  }

  function closeModal() {
    document.getElementById("modalPasien").classList.add("hidden");
  }

  // (Optional) Tangani form submit
  document.getElementById("formPasien").addEventListener("submit", function (e) {
    e.preventDefault();
    // Ambil data dari form
    // const data = new FormData(e.target);
    alert("Pasien ditambahkan!");
    closeModal();
    e.target.reset();
  });
</script>



    <!-- Table -->
    <div class="overflow-auto rounded shadow w-full">
      <table class="w-full table-auto border-collapse text-sm">
        <thead class="bg-[#a8dadc] text-left">
          <tr>
            <th class="p-3">No. ERM</th>
            <th class="p-3">NIK</th>
            <th class="p-3">Nama</th>
            <th class="p-3">Tanggal Lahir</th>
            <th class="p-3">No. Telepon</th>
            <th class="p-3"></th>
          </tr>
        </thead>
        <tbody>
          <!-- Contoh baris pasien -->
          <tr class="border-b">
            <td class="p-3">ERM01</td>
            <td class="p-3">4342040199899</td>
            <td class="p-3">muhammad aidil</td>
            <td class="p-3">1984/05/12</td>
            <td class="p-3">082368790322</td>
            <td class="p-3 space-x-2">
              <button class="bg-yellow-400 text-white px-3 py-1 rounded">Edit</button>
              <button class="bg-red-500 text-white px-3 py-1 rounded">Hapus</button>
            </td>
          </tr>
          
          <tr class="border-b">
            <td class="p-3">ERM02</td>
            <td class="p-3">4342040199899</td>
            <td class="p-3">muhammad aidil</td>
            <td class="p-3">1984/05/12</td>
            <td class="p-3">082368790322</td>
            <td class="p-3 space-x-2">
              <button class="bg-yellow-400 text-white px-3 py-1 rounded">Edit</button>
              <button class="bg-red-500 text-white px-3 py-1 rounded">Hapus</button>
            </td>
          </tr>

          <tr class="border-b">
            <td class="p-3">ERM03</td>
            <td class="p-3">4342040199899</td>
            <td class="p-3">muhammad aidil</td>
            <td class="p-3">1984/05/12</td>
            <td class="p-3">082368790322</td>
            <td class="p-3 space-x-2">
              <button class="bg-yellow-400 text-white px-3 py-1 rounded">Edit</button>
              <button class="bg-red-500 text-white px-3 py-1 rounded">Hapus</button>
            </td>
          </tr>

          <tr class="border-b">
            <td class="p-3">ERM04</td>
            <td class="p-3">4342040199899</td>
            <td class="p-3">muhammad aidil</td>
            <td class="p-3">1984/05/12</td>
            <td class="p-3">082368790322</td>
            <td class="p-3 space-x-2">
              <button class="bg-yellow-400 text-white px-3 py-1 rounded">Edit</button>
              <button class="bg-red-500 text-white px-3 py-1 rounded">Hapus</button>
            </td>
          </tr>

          <tr class="border-b">
            <td class="p-3">ERM05</td>
            <td class="p-3">4342040199899</td>
            <td class="p-3">muhammad aidil</td>
            <td class="p-3">1984/05/12</td>
            <td class="p-3">082368790322</td>
            <td class="p-3 space-x-2">
              <button class="bg-yellow-400 text-white px-3 py-1 rounded">Edit</button>
              <button class="bg-red-500 text-white px-3 py-1 rounded">Hapus</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </main>
</html>

     

        
                

  