@props([
    'role' => null
])

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Kelola Akun Pasien</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('/addon.css') }}">
</head>

<body class="bg-gray-100 font-sans">

    <!-- Sidebar -->
    @if($role == 'MEDIS')
        <x-sidebar.medis></x-sidebar.medis>
    @else
        <x-sidebar.lab></x-sidebar.lab>
    @endif

    <!-- Main content area -->
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
            <div class="p-6 bg-gray-100">

                <h1 class="text-2xl font-bold text-black mb-4">Kelola Akun Pasien</h1>
                <div class="bg-white shadow rounded p-4">

                    <div class="max-w-4xl">

                        <div class="flex items-center mb-6">

                            @if(count($patients) > 0)
                            <!-- Search input with icon -->
                            <div class="join">
                                <select id="filter" class="select">
                                    <option disabtargetled selected>Pilih Filter</option>
                                    <option value="patient_erm">Nomor ERM</option>
                                    <option value="patient_nik">NIK</option>
                                    <option value="full_name">Nama Lengkap</option>
                                    <option value="phone_number">Nomor Telepon</option>
                                </select>
                                <input id="query" class="input join-item" placeholder="Cari..." />
                                <button id="search" class="btn join-item">Cari</button>
                            </div>
                            @endif

                            <!-- Tombol Tambah Pasien -->
                            <button
                                onclick="create_acc_modal.showModal()"
                                class="btn btn-info ml-4">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                Buat Akun Pasien
                            </button>

                            <!-- Open the modal using ID.showModal() method -->
                            <dialog id="create_acc_modal" class="modal">
                                <div class="modal-box">
                                    <h3 class="text-lg font-bold text-center mb-6">Buat Akun Pasien</h3>

                                    <form action="{{ url('/patients/create') }}" method="POST" class="grid grid-cols-1 gap-4" enctype="multipart/form-data">
                                        @csrf
                                        <fieldset class="fieldset">
                                            <legend class="fieldset-legend">Nomor ERM</legend>
                                            <input
                                                name="patient_erm" minlength="4" maxlength="8"
                                                pattern="^ERM\d{4,8}$" type="text" class="input" />
                                        </fieldset>
                                        <fieldset class="fieldset">
                                            <legend class="fieldset-legend">Nama Lengkap</legend>
                                            <input
                                                name="full_name" minlength="3" maxlength="60"
                                                type="text" class="input" />
                                        </fieldset>
                                        <fieldset class="fieldset">
                                            <legend class="fieldset-legend">Nomor Induk Kependudukan</legend>
                                            <input
                                                name="nik" type="text" minlength="16" maxlength="16"
                                                pattern="^[0-9]+$" class="input"  />
                                        </fieldset>
                                        <fieldset class="fieldset">
                                            <legend class="fieldset-legend">Nomor WhatsApp</legend>
                                            <input
                                                name="phone_number"
                                                type="tel" placeholder="08....." class="input"
                                                minlength="10" maxlength="15" pattern="^08\d{8,15}$"
                                            />
                                        </fieldset>
                                        <input type="submit" class="btn btn-info btn-block mt-2" value="KIrim">
                                    </form>
                                    <button class="btn btn-error btn-block mt-2"  onclick="create_acc_modal.close()">Batal</button>
                                </div>
                            </dialog>

                        </div>

                        @if(count($patients) > 0)
                        <!-- List of patients -->
                        <table class="table">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Nomor ERM</th>
                                <th>NIK</th>
                                <th>Nama Lengkap</th>
                                <th>Nomor Telepon</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>

                            <tbody id="patientListBody">
                            @forelse($patients as $patient)
                                <tr>
                                    <td>
                                        @if($patient->info_verified < 1)
                                            <input type="checkbox" class="checkbox" data-account_id="{{ $patient->account_id }}" />
                                        @else
                                            <input type="checkbox" checked="checked" class="checkbox" data-account_id="{{ $patient->account_id }}" />
                                        @endif
                                    </td>
                                    <td>{{ $patient->patient_erm }}</td>
                                    <td>{{ $patient->patient_nik }}</td>
                                    <td>{{ $patient->full_name }}</td>
                                    <td>{{ $patient->phone_number }}</td>
                                    <td>
                                        <a href="/patients/edit/{{ $patient->account_id }}">
                                            <button class="btn btn-info">Ubah</button>
                                        </a>
                                        <a href="/patients/delete/{{ $patient->account_id }}">
                                            <button class="btn btn-error">Hapus</button>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                            </tbody>
                        </table>
                        <div class="join">
                            <button id="previous-page" class="join-item btn btn-md">«</button>
                            <button id="current-page" class="join-item btn btn-md btn-block" data-page="1">Halaman 1</button>
                            <button id="next-page" class="join-item btn btn-md">»</button>
                        </div>
                        @else
                            <p>Belum ada akun pasien</p>
                        @endif
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script type="text/javascript" src="{{ asset('/js/patient-list.js') }}"></script>
</body>
</html>
