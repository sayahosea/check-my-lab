<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard Rekam Medis</title>
  <script src="https://cdn.tailwindcss.com"></script> 
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

<body class="bg-gray-100 font-sans ">

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
    <header class="flex justify-end items-center bg-white shadow px-5 py-3 ">
      <div class="flex items-center gap-4">
          <div class="sm:flex sm:gap-4">
            <a href="landing-page.html"
            class="bg-[#a8dadc] hover:bg-[#7cbac0] text-black font-semibold px-4 py-2 rounded">
              Keluar
            </a>
    </header>

    <!-- Page Content -->
    <h1 class="text-xl font-bold mb-4 mt-8 ml-10 ">
      Selamat datang di website UPT baloi permai!
    </h1>

      <!-- Statistik -->
      <!-- Grafik Container yang lebih kecil -->
<div class="bg-white rounded shadow p-4 mb-6 ml-10 mr-10">
  <h3 class="text-center font-semibold text-sm mb-4 pb-1 border-b-2  bg-[#a8dadc]">
    Statistik Hasil Uji Laboratorium
  </h3>

  <!-- Grafik Lebih Kecil -->
  <div class="max-w-4xl mx-auto p-4 bg-white rounded shadow">
    <canvas id="labChart" class="w-full h-[160px]"></canvas>
  </div>
</div>




  <!-- Statistik -->
  <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6 ml-10 mr-10">
    <div class="bg-white shadow rounded p-4 flex justify-between items-center">
      <div>
        <p class="text-gray-600 text-sm">Total akun pasien</p>
        <h2 class="text-2xl font-bold">50</h2>
      </div>
      <div class="text-purple-600 text-2xl">
        <i class="fas fa-user"></i> <!-- Ganti dengan icon sesuai framework kamu -->
      </div>
    </div>

    <div class="bg-white shadow rounded p-4 flex justify-between items-center">
      <div>
        <p class="text-gray-600 text-sm">Total Hasil Uji TB</p>
        <h2 class="text-2xl font-bold">45</h2>
      </div>
      <div class="text-purple-600 text-2xl">
        <i class="fas fa-vial"></i>
      </div>
    </div>

    <div class="bg-white shadow rounded p-4 flex justify-between items-center">
      <div>
        <p class="text-gray-600 text-sm">Total Akun pegawai</p>
        <h2 class="text-2xl font-bold">5</h2>
      </div>
      <div class="text-purple-600 text-2xl">
        <i class="fas fa-user-md"></i>
      </div>
    </div>
  </div>

  <!-- Aktivitas Terbaru -->
  <div class="bg-white shadow rounded p-4 ml-10 mr-10">
    <div class="flex justify-between items-center mb-4">
      <h3 class="text-lg font-semibold">Aktifitas terbaru</h3>
      <button class="text-sm text-blue-600 hover:underline">Lihat semua</button>
    </div>

    <div class="space-y-4">
      <!-- Item 1 -->
      <div class="flex justify-between">
        <div>
          <p class="font-semibold text-sm flex items-center gap-2">
            <i class="fas fa-user text-purple-500"></i> Akun pasien ditambahkan
          </p>
          <p class="text-sm text-gray-600">434240109999 telah di tambahkan</p>
        </div>
        <span class="text-xs text-gray-500 whitespace-nowrap">2 jam lalu</span>
      </div>

      <!-- Item 2 -->
      <div class="flex justify-between">
        <div>
          <p class="font-semibold text-sm flex items-center gap-2">
            <i class="fas fa-vial text-purple-500"></i> Hasil Uji TB berhasil di tambahkan
          </p>
          <p class="text-sm text-gray-600">Hasil Uji TB 434240109999 berhasil di tambahkan</p>
        </div>
        <span class="text-xs text-gray-500 whitespace-nowrap">5 jam lalu</span>
      </div>

      <!-- Item 3 -->
      <div class="flex justify-between">
        <div>
          <p class="font-semibold text-sm flex items-center gap-2">
            <i class="fas fa-user-md text-purple-500"></i> Akun pegawai ditambahkan
          </p>
          <p class="text-sm text-gray-600">Laboran telah di tambahkan</p>
        </div>
        <span class="text-xs text-gray-500 whitespace-nowrap">1 hari lalu</span>
      </div>
    </div>
  </div>
</div>

<script>
  const ctx = document.getElementById('labChart').getContext('2d');
  const labChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agust', 'Sep', 'Okt', 'Nov', 'Des'],
      datasets: [{
        label: '',
        data: [2, 4, 3, 3, 4, 10, 6, 5, 11, 2, 3, 4],
        borderColor: 'green',
        backgroundColor: 'transparent',
        pointBackgroundColor: 'green',
        pointRadius: 3,
        pointHoverRadius: 4,
        borderWidth: 1.5,
        tension: 0.2,
        fill: false,
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          display: false
        }
      },
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            stepSize: 2,
          },
          grid: {
            drawBorder: false
          }
        },
        x: {
          grid: {
            drawBorder: false,
            display: false
          }
        }
      }
    }
  });
</script>

  
</body>
</html>