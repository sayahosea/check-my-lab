<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Pengaturan Akun</title>
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
    /* Hover pointer untuk list item */
    .option-item:hover {
      background-color: #cce7e8;
      cursor: pointer;
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
        <p class="text-sm text-black leading-tight">Sistem Informasi<br>Hasil Uji TB</p>
      </div>
    </div>

    <nav class="flex flex-col space-y-2">
      <a href="menu-dashboard.html" class="flex items-center gap-4 p-2 rounded-lg hover:bg-indigo-100 text-gray-700 font-semibold">
        <i class="fas fa-home w-5 h-5"></i> Beranda
      </a>
      <a href="data_pasien.html" class="flex items-center gap-4 p-2 rounded-lg hover:bg-indigo-100 text-gray-700 font-semibold">
        <i class="fas fa-user w-5 h-5"></i> Pasien
      </a>
      <a href="hasil_uji_lab.html" class="flex items-center gap-4 p-2 rounded-lg hover:bg-indigo-100 text-gray-700 font-semibold">
        <i class="fas fa-vial w-5 h-5"></i> Hasil Uji Lab
      </a>
      <a href="pengaturan_akun.html" class="flex items-center gap-4 p-2 rounded-lg hover:bg-indigo-100 bg-indigo-200 text-gray-900 font-semibold">
        <i class="fas fa-cog w-5 h-5"></i> Pengaturan Akun
      </a>
    </nav>
  </aside>

  <!-- Main content -->
  <main class="ml-60 flex-1 p-6">
    <header class="flex justify-between items-center mb-6">
      <h1 class="text-2xl font-bold">Pengaturan Akun</h1>
      <button id="btnLogout" class="bg-red-500 hover:bg-red-600 text-white font-semibold px-4 py-2 rounded">Keluar</button>
    </header>

    <!-- Daftar opsi pengaturan -->
    <section id="settingsList" class="bg-white rounded shadow p-6 max-w-xl mx-auto">
      <ul>
        <li id="optionPhone" class="option-item flex justify-between items-center px-4 py-3 border rounded mb-4">
          <span>Nomor Telepon</span>
          <span class="text-gray-500">08********22</span>
          <i class="fas fa-chevron-right text-gray-400"></i>
        </li>
        <li id="optionPassword" class="option-item flex justify-between items-center px-4 py-3 border rounded">
          <span>Kata Sandi</span>
          <span class="text-gray-500">************</span>
          <i class="fas fa-chevron-right text-gray-400"></i>
        </li>
      </ul>
    </section>

    <!-- Form ubah nomor telepon -->
    <section id="formPhone" class="bg-white rounded shadow p-6 max-w-xl mx-auto hidden">
      <button id="backFromPhone" class="mb-4 text-gray-600 hover:text-gray-900 flex items-center gap-2">
        <i class="fas fa-arrow-left"></i> Kembali
      </button>
      <h2 class="text-xl font-semibold mb-4">Ubah Nomor Telepon</h2>
      <input
        type="tel"
        id="inputPhone"
        class="w-full border border-gray-300 rounded px-3 py-2 mb-4"
        placeholder="Masukkan nomor telepon baru"
        value="082368790322"
      />
      <button id="submitPhone" class="bg-[#a8dadc] hover:bg-[#7cbac0] text-black font-semibold px-4 py-2 rounded w-full">
        Kirim
      </button>
    </section>

    <!-- Form ubah kata sandi -->
    <section id="formPassword" class="bg-white rounded shadow p-6 max-w-xl mx-auto hidden">
      <button id="backFromPassword" class="mb-4 text-gray-600 hover:text-gray-900 flex items-center gap-2">
        <i class="fas fa-arrow-left"></i> Kembali
      </button>
      <h2 class="text-xl font-semibold mb-4">Ubah Kata Sandi</h2>
      <input
        type="password"
        id="inputPassword"
        class="w-full border border-gray-300 rounded px-3 py-2 mb-4"
        placeholder="Masukkan kata sandi baru"
      />
      <button id="submitPassword" class="bg-[#a8dadc] hover:bg-[#7cbac0] text-black font-semibold px-4 py-2 rounded w-full">
        Kirim
      </button>
    </section>
  </main>

  <script>
    const btnLogout = document.getElementById('btnLogout');
    const settingsList = document.getElementById('settingsList');
    const formPhone = document.getElementById('formPhone');
    const formPassword = document.getElementById('formPassword');

    const optionPhone = document.getElementById('optionPhone');
    const optionPassword = document.getElementById('optionPassword');

    const backFromPhone = document.getElementById('backFromPhone');
    const backFromPassword = document.getElementById('backFromPassword');

    const submitPhone = document.getElementById('submitPhone');
    const submitPassword = document.getElementById('submitPassword');

    const inputPhone = document.getElementById('inputPhone');
    const inputPassword = document.getElementById('inputPassword');

    btnLogout.addEventListener('click', () => {
      window.location.href = 'login.html'; // Sesuaikan halaman login Anda
    });

    optionPhone.addEventListener('click', () => {
      settingsList.classList.add('hidden');
      formPhone.classList.remove('hidden');
      inputPhone.focus();
    });

    optionPassword.addEventListener('click', () => {
      settingsList.classList.add('hidden');
      formPassword.classList.remove('hidden');
      inputPassword.focus();
    });

    backFromPhone.addEventListener('click', () => {
      formPhone.classList.add('hidden');
      settingsList.classList.remove('hidden');
    });

    backFromPassword.addEventListener('click', () => {
      formPassword.classList.add('hidden');
      settingsList.classList.remove('hidden');
    });

    submitPhone.addEventListener('click', () => {
      alert(`Nomor telepon berhasil diubah menjadi: ${inputPhone.value}`);
      formPhone.classList.add('hidden');
      settingsList.classList.remove('hidden');
    });

    submitPassword.addEventListener('click', () => {
      alert(`Kata sandi berhasil diubah.`);
      formPassword.classList.add('hidden');
      settingsList.classList.remove('hidden');
      inputPassword.value = '';
    });
  </script>
</body>
</html>
