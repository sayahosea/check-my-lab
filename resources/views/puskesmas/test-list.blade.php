@props([ "role" => null ])

    <!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Hasil Uji Lab</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('/addon.css') }}">
</head>

<body class="bg-gray-100 font-sans overflow-hidden min-h-screen">

<!-- Sidebar -->
@if($role == "MEDIS")
    <x-sidebar.medis></x-sidebar.medis>
@else
    <x-sidebar.lab></x-sidebar.lab>
@endif

<!-- Main content -->
<div class="ml-60 min-h-screen">

    <!-- Navbar -->
    <x-navbar></x-navbar>

    @if(session('alert_msg'))
        <div class="toast toast-top toast-center">
            <div class="alert {{ session('alert_color') }}">
                <span>{{ session('alert_msg') }}</span>
            </div>
        </div>
    @endif

    <!-- Page Content -->
    <main class="ml-10 p-6">

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
                    @forelse($patients as $patient)
                        <li class="patient-item cursor-pointer p-2 rounded hover:bg-indigo-100"
                            data-id="{{ $patient->account_id }}"
                            data-erm="{{ $patient->patient_erm }}"
                            data-nik="{{ $patient->patient_nik }}">
                            {{ $patient->full_name }}
                        </li>
                    @empty
                        <li class="patient-item cursor-pointer p-2 rounded hover:bg-indigo-100">
                            Belum ada hasil uji
                        </li>
                    @endforelse
                </ul>
            </section>

            <!-- Daftar hasil uji -->
            <section id="testResultsSection" class="flex-1 bg-white rounded shadow p-4 flex flex-col">
                <div class="flex items-center justify-between mb-4">
                    <h2 id="selectedPatientName" class="text-xl font-semibold flex items-center gap-2">
                        <i class="fas fa-user-circle"></i> Pilih pasien untuk lihat hasil uji
                    </h2>
                    @if($role == 'LAB')
                        <x-button
                            id="btnAddFile"
                            color="bg-[#a8dadc]"
                            hover="bg-[#7cbac0]"
                            text="Unggah Hasil Uji"
                            icon_path="M12 4.5v15m7.5-7.5h-15"
                            url="/tests/upload"
                        ></x-button>
                    @endif
                </div>

                <div class="overflow-x-auto rounded-box border border-base-content/5 bg-base-100">
                    <table class="table" id="testResultsTable">
                        <!-- head -->
                        <thead>
                        <tr class="bg-[#a8dadc] text-black">
                            <th>Nomor ERM</th>
                            <th>Tanggal Uji Tes</th>
                            <th>NIK Pasien</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody id="testResultsBody">
                        </tbody>
                    </table>
                </div>
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
</div>

<script src="{{ @asset('/js/test-list.js') }}"></script>
</body>
</html>
