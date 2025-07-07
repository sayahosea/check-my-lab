<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Kelola Akun Pegawai</title>
    @vite('resources/css/app.css')

    <link rel="stylesheet" href="{{ asset('/addon.css') }}">
</head>

<body class="bg-gray-100 font-sans">

    <!-- Sidebar -->
    <x-sidebar.medis></x-sidebar.medis>

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
            <div class="p-6 bg-gray-100 min-h-screen">

                <h1 class="text-2xl font-bold text-black mb-4">Kelola Akun Pegawai</h1>
                <div class="bg-white shadow rounded p-4">
                    <div class="flex items-center gap-4 mt-6 ml-6 mb-6">

                        <!-- Search input with icon -->
                        <div class="relative ml-10 w-full max-w-md">
                            <input
                                type="text"
                                placeholder="Cari Akun"
                                class="w-full border border-gray-300 rounded px-4 py-2 pl-10 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            />
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                </svg>
                            </div>
                        </div>

                        <!-- Tombol Tambah Pasien -->
                        <a
                            href="{{ url('/staffs/create') }}"
                            class="flex items-center gap-2 bg-blue-100 hover:bg-blue-200 text-blue-900 font-semibold py-2 px-4 rounded border border-blue-300">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            Tambah Akun
                        </a>

                    </div>

                    <div class="max-w-4xl mx-auto mt-8">

                        <!-- List of patients -->
                        <table class="min-w-full divide-y-2 divide-gray-200">
                            <thead class="ltr:text-left rtl:text-right">
                            <tr class="*:font-medium *:text-gray-900">
                                <th class="px-3 py-2 whitespace-nowrap">Nama Lengkap</th>
                                <th class="px-3 py-2 whitespace-nowrap">Nomor Telepon</th>
                                <th class="px-3 py-2 whitespace-nowrap">Peran</th>
                                <th class="px-3 py-2 whitespace-nowrap">Aksi</th>
                            </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200">
                            @forelse($staffs as $staff)
                                <tr class="*:text-gray-900 *:first:font-medium">
                                    <td class="px-3 py-2 whitespace-nowrap">{{ $staff->full_name }}</td>
                                    <td class="px-3 py-2 whitespace-nowrap">{{ $staff->phone_number }}</td>
                                    <td class="px-3 py-2 whitespace-nowrap">{{ $staff->role }}</td>
                                    <td class="px-3 py-2 whitespace-nowrap">
                                        <a href="/staffs/edit/{{ $staff->account_id }}">
                                            <button class="btn btn-info">Ubah</button>
                                        </a>
                                        <a href="/staffs/delete/{{ $staff->account_id }}">
                                            <button class="btn btn-error">Hapus</button>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
