<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dashboard Pasien</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <style>
    /* Custom scrollbar untuk sidebar */
    .sidebar::-webkit-scrollbar {
      width: 8px;
    }
    .sidebar::-webkit-scrollbar-thumb {
      background-color: #70a89d;
      border-radius: 10px;
    }
  </style>
</head>
<body class="bg-gray-100 font-sans flex min-h-screen">

  <!-- Sidebar -->
  <aside class="sidebar fixed top-0 left-0 h-full w-60 bg-[#a8dadc] px-4 py-6 shadow-lg overflow-y-auto">
    <div class="flex items-center space-x-2 mb-10">
      <img src="logopuskesmas.png" alt="Logo" class="w-20 h-20" />
      <div>
        <h1 class="text-xl font-bold text-black">CheckMyLab</h1>
        <p class="text-sm text-black leading-tight">UPT Puskesmas<br>Baloi Permai</p>
      </div>
    </div>

    <nav class="flex flex-col space-y-2">
      <a href="menu-dashboard.html" class="flex items-center gap-4 p-2 rounded-lg hover:bg-indigo-100 text-gray-700 font-semibold">
        <i class="fas fa-home w-5 h-5"></i> Beranda
      </a>
      <a href="data_pasien.html" class="flex items-center gap-4 p-2 rounded-lg hover:bg-indigo-100 bg-indigo-200 text-gray-900 font-semibold">
        <i class="fas fa-user w-5 h-5"></i> Pasien
      </a>
      <a href="menu-hasil-uji-lab.html" class="flex items-center gap-4 p-2 rounded-lg hover:bg-indigo-100 text-gray-700 font-semibold">
        <i class="fas fa-vial w-5 h-5"></i> Hasil Uji Lab
      </a>
      <a href="menu-pengaturan-akun.html" class="flex items-center gap-4 p-2 rounded-lg hover:bg-indigo-100 text-gray-700 font-semibold">
        <i class="fas fa-cog w-5 h-5"></i> Pengaturan Akun
      </a>
    </nav>
  </aside>

  <!-- Main content -->
  <main class="ml-60 flex-1 p-6 flex flex-col">
    <header class="flex justify-between items-center mb-6">
      <h1 class="text-2xl font-bold">Data Pasien</h1>
      <div class="flex gap-4">
        <button id="btnToggleForm" class="bg-[#a8dadc] hover:bg-[#7cbac0] text-black font-semibold px-4 py-2 rounded">+ Tambah Pasien</button>
        <button id="btnLogout" class="bg-red-500 hover:bg-red-600 text-white font-semibold px-4 py-2 rounded">Keluar</button>
      </div>
    </header>

    <div class="flex gap-6 flex-1 overflow-hidden">

      <!-- Tabel dan Search -->
      <section class="flex-1 overflow-auto bg-white rounded shadow p-4">
        <div class="mb-4 flex items-center gap-4">
          <input
            id="searchInput"
            type="text"
            placeholder="Cari pasien"
            class="flex-grow border border-gray-300 rounded px-3 py-2"
          />
        </div>

        <table class="w-full text-left border-collapse">
          <thead>
            <tr class="bg-[#a8dadc] text-black">
              <th class="py-2 px-4 border">No. ERM</th>
              <th class="py-2 px-4 border">NIK</th>
              <th class="py-2 px-4 border">Nama</th>
              <th class="py-2 px-4 border">Tanggal Lahir</th>
              <th class="py-2 px-4 border">No. Telepon</th>
              <th class="py-2 px-4 border">Aksi</th>
            </tr>
          </thead>
          <tbody id="patientTableBody">
            <tr>
              <td class="py-2 px-4 border">ERM01</td>
              <td class="py-2 px-4 border">434240109999</td>
              <td class="py-2 px-4 border">Aldireno Hosen</td>
              <td class="py-2 px-4 border">1994/05/21</td>
              <td class="py-2 px-4 border">082368790322</td>
              <td class="py-2 px-4 border">
                <button class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Rincian</button>
              </td>
            </tr>
            <tr>
              <td class="py-2 px-4 border">ERM02</td>
              <td class="py-2 px-4 border">434240109887</td>
              <td class="py-2 px-4 border">Ahmad Ariq</td>
              <td class="py-2 px-4 border">1998/01/15</td>
              <td class="py-2 px-4 border">082368790322</td>
              <td class="py-2 px-4 border">
                <button class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Rincian</button>
              </td>
            </tr>
          </tbody>
        </table>
      </section>

      <!-- Form Tambah Pasien (hidden default) -->
      <section id="addPatientSection" class="w-96 bg-white rounded shadow p-6 hidden flex-col">
        <h2 class="text-xl font-semibold mb-4">Tambah Pasien</h2>
        <form id="addPatientForm" class="flex flex-col gap-4">
          <input type="text" id="noErm" placeholder="No. ERM" class="border border-gray-300 rounded px-3 py-2" required />
          <input type="text" id="nik" placeholder="NIK" class="border border-gray-300 rounded px-3 py-2" required />
          <input type="text" id="nama" placeholder="Nama" class="border border-gray-300 rounded px-3 py-2" required />
          <input type="date" id="tanggalLahir" placeholder="Tanggal Lahir" class="border border-gray-300 rounded px-3 py-2" required />
          <input type="tel" id="noTelepon" placeholder="No. Telepon" class="border border-gray-300 rounded px-3 py-2" required />
          <div class="flex justify-end gap-2 pt-4">
            <button type="button" id="btnCancelForm" class="px-4 py-2 rounded border border-gray-400 hover:bg-gray-100">Batal</button>
            <button type="submit" class="bg-[#a8dadc] hover:bg-[#7cbac0] text-black font-semibold px-4 py-2 rounded">Tambahkan</button>
          </div>
        </form>
      </section>

    </div>
  </main>

  <script>
    const btnToggleForm = document.getElementById('btnToggleForm');
    const addPatientSection = document.getElementById('addPatientSection');
    const btnCancelForm = document.getElementById('btnCancelForm');
    const addPatientForm = document.getElementById('addPatientForm');
    const patientTableBody = document.getElementById('patientTableBody');
    const searchInput = document.getElementById('searchInput');
    const btnLogout = document.getElementById('btnLogout');

    // Toggle tampilan form tambah pasien
    btnToggleForm.addEventListener('click', () => {
      if (addPatientSection.classList.contains('hidden')) {
        addPatientSection.classList.remove('hidden');
        btnToggleForm.textContent = 'Tutup Form';
      } else {
        addPatientSection.classList.add('hidden');
        btnToggleForm.textContent = '+ Tambah Pasien';
      }
    });

    // Tombol batal sembunyikan form
    btnCancelForm.addEventListener('click', () => {
      addPatientSection.classList.add('hidden');
      btnToggleForm.textContent = '+ Tambah Pasien';
      addPatientForm.reset();
    });

    // Submit form tambah pasien
    addPatientForm.addEventListener('submit', (e) => {
      e.preventDefault();
      const noErm = document.getElementById('noErm').value.trim();
      const nik = document.getElementById('nik').value.trim();
      const nama = document.getElementById('nama').value.trim();
      const tanggalLahir = document.getElementById('tanggalLahir').value;
      const noTelepon = document.getElementById('noTelepon').value.trim();

      // Tambah data ke tabel
      const newRow = document.createElement('tr');
      newRow.innerHTML = `
        <td class="py-2 px-4 border">${noErm}</td>
        <td class="py-2 px-4 border">${nik}</td>
        <td class="py-2 px-4 border">${nama}</td>
        <td class="py-2 px-4 border">${tanggalLahir}</td>
        <td class="py-2 px-4 border">${noTelepon}</td>
        <td class="py-2 px-4 border">
          <button class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Rincian</button>
        </td>
      `;
      patientTableBody.appendChild(newRow);

      addPatientForm.reset();
      addPatientSection.classList.add('hidden');
      btnToggleForm.textContent = '+ Tambah Pasien';
    });

    // Search filter pasien
    searchInput.addEventListener('input', () => {
      const filter = searchInput.value.toLowerCase();
      const rows = patientTableBody.getElementsByTagName('tr');

      for (let row of rows) {
        const cells = row.getElementsByTagName('td');
        let match = false;
        for (let cell of cells) {
          if (cell.textContent.toLowerCase().includes(filter)) {
            match = true;
            break;
          }
        }
        row.style.display = match ? '' : 'none';
      }
    });

    // Fungsi tombol logout redirect ke halaman login.html
    btnLogout.addEventListener('click', () => {
      window.location.href = 'login.html'; // Ganti dengan URL halaman login Anda
    });
  </script>
</body>
</html>
