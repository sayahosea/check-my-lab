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

                    <div class="max-w-4xl mx-auto mt-8">

                        <div class="flex items-center gap-4 mt-6 ml-6 mb-6">

                            <!-- Search input with icon -->
                            <div class="join">
                                <select id="filter" class="select">
                                    <option disabled selected>Pilih Filter</option>
                                    <option value="patient_erm">Nomor ERM</option>
                                    <option value="patient_nik">NIK</option>
                                    <option value="full_name">Nama Lengkap</option>
                                    <option value="phone_number">Nomor Telepon</option>
                                </select>
                                <input id="query" class="input join-item" placeholder="Cari..." />
                                <button id="search" class="btn join-item">Cari</button>
                            </div>

                            @if($role == 'MEDIS')
                                <!-- Tombol Tambah Pasien -->
                                <a
                                    href="{{ url('/patients/create') }}"
                                    class="flex items-center gap-2 bg-blue-100 hover:bg-blue-200 text-blue-900 font-semibold py-2 px-4 rounded border border-blue-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                    </svg>
                                    Tambah Pasien
                                </a>
                            @endif
                        </div>

                        <!-- List of patients -->
                        <table class="min-w-full divide-y-2 divide-gray-200">
                            <thead class="ltr:text-left rtl:text-right">
                            <tr class="*:font-medium *:text-gray-900">
                                <th class="px-3 py-2 whitespace-nowrap">Nomor ERM</th>
                                <th class="px-3 py-2 whitespace-nowrap">NIK</th>
                                <th class="px-3 py-2 whitespace-nowrap">Nama Lengkap</th>
                                <th class="px-3 py-2 whitespace-nowrap">Nomor Telepon</th>
                                <th class="px-3 py-2 whitespace-nowrap">Aksi</th>
                            </tr>
                            </thead>

                            <tbody id="patientListBody" class="divide-y divide-gray-200">
                            @forelse($patients as $patient)
                                <tr class="*:text-gray-900 *:first:font-medium">
                                    <td class="px-3 py-2 whitespace-nowrap">{{ $patient->patient_erm }}</td>
                                    <td class="px-3 py-2 whitespace-nowrap">{{ $patient->patient_nik }}</td>
                                    <td class="px-3 py-2 whitespace-nowrap">{{ $patient->full_name }}</td>
                                    <td class="px-3 py-2 whitespace-nowrap">{{ $patient->phone_number }}</td>
                                    <td class="px-3 py-2 whitespace-nowrap">
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
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script type="text/javascript" src="{{ asset('/js/patient-list.js') }}"></script>
</body>
</html>
