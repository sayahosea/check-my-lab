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
</div>

    <!-- Table -->
    <div class="overflow-auto rounded shadow w-full">
      <section id="listPasien"><table class="w-full bg-white shadow text-sm rounded">
        <thead>
          <tr class="bg-[#a8dadc] text-left">
            <th class="p-3">No. ERM</th>
            <th class="p-3">NIK</th>
            <th class="p-3">Nama</th>
            <th class="p-3">Tanggal Lahir</th>
            <th class="p-3">No. Telepon</th>
            <th class="p-3"></th>
          </tr>
        </thead>
        <tbody id="pasienTable"></tbody>
      </table>
    </section>
      
    <section id="rincianPasien" class="hidden">
      <button onclick="backToList()" class="text-black mb-2 ml-2 text-2xl">&larr;</button>
      <h2 class="text-lg font-semibold mb-2" id="namaPasien">Pasien</h2>
      <table class="w-full bg-white shadow rounded">
        <thead>
          <tr class="bg-[#a8dadc] text-left text-sm">
            <th class="py-2 px-4">Tanggal Uji Tes</th>
            <th class="py-2 px-4">File Hasil Uji</th>
          </tr>
        </thead>
        <tbody id="hasilTable"></tbody>
      </table>
    </section>

  </main>

  <!-- Script -->
  <script>
    const pasien = [
      {
        erm: 'ERM01',
        nik: '4342040109999',
        nama: 'Alldreno Hosea',
        lahir: '1994/05/12',
        telp: '082368790322',
        hasil: ['2024/08/11', '2024/05/26', '2024/02/19']
      },
      {
        erm: 'ERM02',
        nik: '4342040109887',
        nama: 'Ahmad Ariq',
        lahir: '1999/07/19',
        telp: '082368790322',
        hasil: ['2024/03/21']
      },
      {
        erm: 'ERM03',
        nik: '4342040109888',
        nama: 'Aidil Jepri',
        lahir: '1997/09/05',
        telp: '082368790322',
        hasil: ['2024/01/14']
      },
      {
        erm: 'ERM04',
        nik: '4342040109895',
        nama: 'Adib Zahran',
        lahir: '1991/06/06',
        telp: '082368790322',
        hasil: []
      },
      {
        erm: 'ERM05',
        nik: '4342040108777',
        nama: 'Naomi Nisa',
        lahir: '2000/03/04',
        telp: '082368790322',
        hasil: ['2024/06/01']
      }
    ];

    const pasienTable = document.getElementById("pasienTable");
    const hasilTable = document.getElementById("hasilTable");
    const listPasien = document.getElementById("listPasien");
    const rincianPasien = document.getElementById("rincianPasien");
    const namaPasien = document.getElementById("namaPasien");

    function loadPasien() {
      pasien.forEach((p, i) => {
        const row = document.createElement("tr");
        row.className = "border-t";
        row.innerHTML = `
          <td class="py-2 px-4">${p.erm}</td>
          <td class="py-2 px-4">${p.nik}</td>
          <td class="py-2 px-4">${p.nama}</td>
          <td class="py-2 px-4">${p.lahir}</td>
          <td class="py-2 px-4">${p.telp}</td>
          <td class="py-2 px-4">
            <button onclick="showRincian(${i})" class="bg-[#C8EEFF] hover:bg-[#88C9E8]  text-black py-1 px-4 rounded">Rincian</button>
          </td>
        `;
        pasienTable.appendChild(row);
      });
    }

    function showRincian(index) {
      const data = pasien[index];
      namaPasien.textContent = `👤 ${data.nama}`;
      hasilTable.innerHTML = "";

      if (data.hasil.length === 0) {
        hasilTable.innerHTML = `<tr><td class="py-2 px-4" colspan="2">Belum ada hasil uji</td></tr>`;
      } else {
        data.hasil.forEach(tgl => {
          const row = document.createElement("tr");
          row.className = "border-t";
          row.innerHTML = `
            <td class="py-2 px-4">${tgl}</td>
            <td class="py-2 px-4">
              <button class="bg-yellow-400 hover:bg-yellow-500 text-white py-1 px-4 rounded mr-2">Edit</button>
              <button class="bg-red-500 hover:bg-red-600 text-white py-1 px-4 rounded">Hapus</button>
            </td>
          `;
          hasilTable.appendChild(row);
        });
      }

      listPasien.classList.add("hidden");
      rincianPasien.classList.remove("hidden");
    }

    function backToList() {
      rincianPasien.classList.add("hidden");
      listPasien.classList.remove("hidden");
    }

    loadPasien();
  </script>

      </table>
    </div>
  </main>
</html>