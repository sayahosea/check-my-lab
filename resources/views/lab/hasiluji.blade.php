<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Hasil Uji Lab</title>
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
      <a href="hasil_uji_lab.html" class="flex items-center gap-4 p-2 rounded-lg hover:bg-indigo-100 bg-indigo-200 text-gray-900 font-semibold">
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
      <h1 class="text-2xl font-bold">Hasil Uji Lab</h1>
      <button id="btnLogout" class="bg-red-500 hover:bg-red-600 text-white font-semibold px-4 py-2 rounded">Keluar</button>
    </header>

    <div class="flex gap-6 flex-1 overflow-hidden">

      <!-- Daftar pasien dan search -->
      <section class="w-96 overflow-auto bg-white rounded shadow p-4 flex flex-col">
        <input
          id="searchPatientInput"
          type="text"
          placeholder="Cari pasien"
          class="mb-4 border border-gray-300 rounded px-3 py-2"
        />
        <ul id="patientList" class="flex flex-col gap-2 overflow-auto" style="max-height: 500px;">
          <li class="patient-item cursor-pointer p-2 rounded hover:bg-indigo-100" data-erm="ERM01" data-nama="Aldireno Hosea" data-nik="434240109999">
            <i class="fas fa-user-circle mr-2 text-gray-600"></i> Aldireno Hosea
          </li>
          <li class="patient-item cursor-pointer p-2 rounded hover:bg-indigo-100" data-erm="ERM02" data-nama="Ahmad Ariq" data-nik="434240109887">
            <i class="fas fa-user-circle mr-2 text-gray-600"></i> Ahmad Ariq
          </li>
        </ul>
      </section>

      <!-- Daftar hasil uji -->
      <section id="testResultsSection" class="flex-1 bg-white rounded shadow p-4 flex flex-col">
        <div class="flex items-center justify-between mb-4">
          <h2 id="selectedPatientName" class="text-xl font-semibold flex items-center gap-2">
            <i class="fas fa-user-circle"></i> Pilih pasien untuk lihat hasil uji
          </h2>
          <button id="btnAddFile" class="bg-[#a8dadc] hover:bg-[#7cbac0] text-black font-semibold px-4 py-2 rounded" disabled>
            + Tambah File Hasil Uji
          </button>
        </div>

        <table class="w-full text-left border-collapse" id="testResultsTable">
          <thead>
            <tr class="bg-[#a8dadc] text-black">
              <th class="py-2 px-4 border">Tanggal Uji Tes</th>
              <th class="py-2 px-4 border">File Hasil Uji</th>
              <th class="py-2 px-4 border">Aksi</th>
            </tr>
          </thead>
          <tbody id="testResultsBody">
          </tbody>
        </table>
      </section>

      <!-- Form tambah file hasil uji (hidden default) -->
      <section id="addFileSection" class="hidden flex-1 bg-white rounded shadow p-6 flex flex-col">
        <div class="flex justify-between items-center mb-4">
          <h2 class="text-xl font-semibold">Tambah File Hasil Uji</h2>
          <button id="btnCloseAddFile" class="text-gray-600 hover:text-gray-900 text-2xl font-bold">&times;</button>
        </div>
        <form id="formAddFile" class="flex flex-col gap-4">
          <input type="text" id="inputNoErm" placeholder="No. ERM" class="border border-gray-300 rounded px-3 py-2" readonly />
          <input type="date" id="inputTanggalTes" placeholder="Tanggal Uji Tes" class="border border-gray-300 rounded px-3 py-2" required />
          <input type="file" id="inputFileHasil" placeholder="Tambahkan File" class="border border-gray-300 rounded px-3 py-2" required />
          <button type="submit" class="bg-[#a8dadc] hover:bg-[#7cbac0] text-black font-semibold px-4 py-2 rounded mt-auto">Unggah file</button>
        </form>
      </section>

    </div>
  </main>

  <script>
    const btnLogout = document.getElementById('btnLogout');
    const patientList = document.getElementById('patientList');
    const selectedPatientName = document.getElementById('selectedPatientName');
    const btnAddFile = document.getElementById('btnAddFile');
    const testResultsSection = document.getElementById('testResultsSection');
    const addFileSection = document.getElementById('addFileSection');
    const btnCloseAddFile = document.getElementById('btnCloseAddFile');
    const formAddFile = document.getElementById('formAddFile');
    const inputNoErm = document.getElementById('inputNoErm');
    const inputTanggalTes = document.getElementById('inputTanggalTes');
    const inputFileHasil = document.getElementById('inputFileHasil');
    const testResultsBody = document.getElementById('testResultsBody');
    const searchPatientInput = document.getElementById('searchPatientInput');

    let selectedPatient = null;

    const testData = {
      'ERM01': [
        { tanggal: '2024/08/11', file: 'File1.pdf' },
        { tanggal: '2024/05/26', file: 'File2.pdf' },
        { tanggal: '2024/02/19', file: 'File3.pdf' }
      ],
      'ERM02': [
        { tanggal: '2024/06/15', file: 'FileA.pdf' },
        { tanggal: '2024/07/20', file: 'FileB.pdf' }
      ]
    };

    btnLogout.addEventListener('click', () => {
      window.location.href = 'login.html';
    });

    function renderTestResults(erm) {
      testResultsBody.innerHTML = '';
      const tests = testData[erm] || [];
      tests.forEach(({tanggal, file}, idx) => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
          <td class="py-2 px-4 border">${tanggal}</td>
          <td class="py-2 px-4 border">${file}</td>
          <td class="py-2 px-4 border">
            <button class="edit-btn bg-yellow-300 text-black px-3 py-1 rounded mr-2 hover:bg-yellow-400">Edit</button>
            <button class="delete-btn bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Hapus</button>
          </td>
        `;
        tr.querySelector('.delete-btn').addEventListener('click', () => {
          tests.splice(idx, 1);
          renderTestResults(erm);
        });
        tr.querySelector('.edit-btn').addEventListener('click', () => {
          alert(`Edit file hasil uji tanggal ${tanggal} pasien ${selectedPatient.nama}`);
        });
        testResultsBody.appendChild(tr);
      });
    }

    patientList.querySelectorAll('.patient-item').forEach(item => {
      item.addEventListener('click', () => {
        patientList.querySelectorAll('.patient-item').forEach(i => i.classList.remove('bg-indigo-200', 'text-gray-900'));
        item.classList.add('bg-indigo-200', 'text-gray-900');

        selectedPatient = {
          erm: item.getAttribute('data-erm'),
          nama: item.getAttribute('data-nama'),
          nik: item.getAttribute('data-nik')
        };

        selectedPatientName.innerHTML = `<i class="fas fa-user-circle"></i> ${selectedPatient.nama}`;
        btnAddFile.disabled = false;

        renderTestResults(selectedPatient.erm);

        // Pastikan tampilan daftar hasil uji aktif dan form tambah file disembunyikan
        testResultsSection.classList.remove('hidden');
        addFileSection.classList.add('hidden');
      });
    });

    btnAddFile.addEventListener('click', () => {
      if (!selectedPatient) return;
      inputNoErm.value = selectedPatient.erm;
      inputTanggalTes.value = '';
      inputFileHasil.value = '';

      // Sembunyikan daftar hasil uji dan tampilkan form tambah file
      testResultsSection.classList.add('hidden');
      addFileSection.classList.remove('hidden');
    });

    btnCloseAddFile.addEventListener('click', () => {
      // Tutup form tambah file, kembali ke daftar hasil uji
      addFileSection.classList.add('hidden');
      testResultsSection.classList.remove('hidden');
    });

    formAddFile.addEventListener('submit', e => {
      e.preventDefault();
      const tanggal = inputTanggalTes.value;
      const fileName = inputFileHasil.files.length ? inputFileHasil.files[0].name : 'File.pdf';

      if (!testData[selectedPatient.erm]) testData[selectedPatient.erm] = [];
      testData[selectedPatient.erm].push({ tanggal, file: fileName });

      renderTestResults(selectedPatient.erm);

      // Kembali ke tampilan daftar hasil uji setelah tambah file
      addFileSection.classList.add('hidden');
      testResultsSection.classList.remove('hidden');
    });

    searchPatientInput.addEventListener('input', () => {
      const filter = searchPatientInput.value.toLowerCase();
      patientList.querySelectorAll('.patient-item').forEach(item => {
        const text = item.textContent.toLowerCase();
        item.style.display = text.includes(filter) ? '' : 'none';
      });
    });
  </script>
</body>
</html>
